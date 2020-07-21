<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use App\Service\Helper;

class Movtochamado extends Model
{
   protected $fillable = ['titulo','status',
   'descricao','user_id', 'chamado_id', 
   'atendimento', 'tecnico', 'ativo', 'tipochamado_id',
   'unidade_id'];

   protected $perPage = 8;

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   }

   public function tipochamado():object{
     return $this->belongsTo(TipoChamado::class);
   }
   
   public function setDescricaoAttribute($desc):void{
    $this->attributes['descricao'] = 
    mb_strtoupper($desc);
   }

   public function setAtendimentoAttribute($desc):void{
    $this->attributes['atendimento'] = 
    mb_strtoupper($desc);
   }
   
   public function store_mc(Chamado $chamado, 
   	                        array $dados): bool{
    try{
   	   $chamado->movtoChamados()
   	   ->create($dados);

   	 }catch(\Exception $e){
       return false;
   	 }
   	 return true;
   } 

   public function getUltimoMovto(int $chamado_id)
   :?object{

     $chamado = $this::where('id', 
     $chamado_id)->orderBy('created_at', 'desc')
     ->get()->first();

     return $chamado;
   }

   public function getUltimoChamado(int $chamado_id)
   :?object{

     $chamado = $this::where('chamado_id', 
     $chamado_id)->orderBy('created_at', 'desc')
     ->get()->first();

     return $chamado;
   }

   public function getUltimoChamadoUsuario()
    :object{
      return $this::where('user_id',
      auth()->user()->id)
      ->where('ativo', true)
      ->get()->last();
    }


   public function atendimentoChamado(array $unidades):object{
         
     $chamados = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')     
     ->select('m.chamado_id', 'm.status', 'm.descricao', 
      'm.created_at', 'm.titulo', 'u.name', 'm.id', 'm.tecnico',
      'm.unidade_id')
      ->where('ativo', true)
      ->where('m.status', '<>', FECHADO)
      ->whereIn('m.unidade_id',  $unidades)
      ->paginate($this->perPage);
    
     return $chamados;
   }

   public function atenderChamado(int $movto_id)
   :object{

     $chamado = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id', 'm.status', 
      'm.descricao', 'm.created_at',
      'm.titulo', 'm.id','u.email', 'm.tipochamado_id',
       'm.tecnico')
      ->where('m.id', $movto_id)
      ->get();

      return $chamado;      
   }  

   public function updateTecnico(array $dados)
   :bool{
     
     try{
       $movto = $this::find($dados['movtoId']);
       $movto->tecnico = auth()->user()->name;
       $movto->save(); 
     }catch(\Exception $e){
      return false;
     }  
     return true;
   }

   public function retornoTecnico(Request $req)
   :array{
     try{

      //dd($req);
      
       $movto = Movtochamado::where('id', 
       $req->movtoId)->orderby('id','desc')
       ->first();

       $movto->ativo = false;
       $movto->save();

       if($req->arquivo)
         DB::beginTransaction(); 
              
       $newMovto = Movtochamado::create([
         "titulo" => $movto->titulo,
         "tipo" => $movto->tipo,
         "status" => USUARIO,
         "descricao" => $movto->descricao,
         "user_id" => $movto->user_id,
         "atendimento" => $req->atendimento,
         "tecnico" => auth()->user()->name,
         "unidade_id" => $movto->unidade_id,
         "chamado_id" => $movto->chamado_id,
         "tipochamado_id" => $req->tipochamado_id
        ]);     

      }catch(\Exception $e){ 
        dd($e->getMessage());       
        $chamado = ['id' => $movto->chamado_id,
                    'result' => false];

        return $chamado;
      }

      if(isset($req->arquivo)){
        
        $arquivo = (new Arquivo())
        ->store_a($req, $movto->chamado);

        if($newMovto and $arquivo):
          DB::commit();
          return ['id' => $movto->chamado_id,
                  'result' => true];
        else:             
          DB::rollback();
          return false;
        endif;
      }    
      
      $chamado = ['id' => $movto->chamado_id,
                  'result' => true];

      return $chamado;
   }   

   public function reabrirChamado(Request $req)
   :bool{

      if(isset($req->arquivo))
        DB::beginTransaction();  
            
      $movto = $this::getUltimoMovto($req->id);
      $movto->ativo = false;
      $movto->save();
      
      try{
        $newmovto = Movtochamado::create([
           "titulo" =>  $movto->titulo,
           "tipo" =>  $movto->tipo,
           "status" => REABERTO,
           "descricao" =>  $req->descricao,
           "user_id" =>  $movto->user_id,
           "tecnico" =>  $movto->tecnico,
           "unidade_id" => $movto->unidade_id,
           "chamado_id" =>  $movto->chamado_id,
           "tipochamado_id" => $movto->tipochamado_id
        ]);   
      }catch(Exception $e){
        return false;
      }

      if(isset($req->arquivo)){
        $arquivo = (new Arquivo())
        ->store_a($req, $movto->chamado);

        if($newmovto and $arquivo):
          DB::commit();
          return true;
        else:
           DB::rollback();
           return false;
        endif;
      } 
      
      return true;
   }

   public function historicoChamado(int $chamado_id)
   :object{
     
     $historico = 
     $this::where('chamado_id',$chamado_id)
     ->select('created_at', 'descricao', 
     'atendimento')->distinct()->get();

     return $historico;
   }

   public function filtrarAtendimento(array $dados)
   :object{
     
     $unidadesAtend = (new Helper())->getUnidadesAtendimento();

     switch ($dados) {
       case isset($dados['titulo']):
        return $this->query()
        ->where('ativo', true)
        ->where('titulo', 'like', '%'.$dados['titulo'].'%')
        ->where('status', '!=', FECHADO) 
        ->whereIn('unidade_id', $unidadesAtend)       
        ->orderby('created_at', 'desc')
        ->paginate();
       break;

       case isset($dados['status']):
         return $this->query()
         ->where('ativo', true)
         ->where('status', $dados['status'])
         ->where('status', '!=', FECHADO)
         ->whereIn('unidade_id', $unidadesAtend)        
         ->orderby('created_at', 'desc')
         ->paginate();
       break;

       case isset($dados['data']):
         $dt = date('d/m/Y', strtotime($dados['data']));
         return $this::where('ativo', true)
         ->where(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y")'), $dt)
         ->where('status', '!=', FECHADO)
         ->whereIn('unidade_id', $unidadesAtend)         
         ->paginate(); 
       break;  

      case isset($dados['name']):
       return DB::table('movtoChamados as m')
        ->join('users as u', 'u.id', 'm.user_id')
        ->select('m.id', 'm.titulo', 'm.status', 'm.chamado_id as chamado_id','m.created_at', 'u.name', 'm.tecnico')
        ->where('u.name', 'like', '%'.$dados['name'].'%')
        ->where('m.ativo', true)
        ->where('status', '!=', FECHADO)
        ->whereIn('unidade_id', $unidadesAtend)
        ->paginate(); 
       break; 

      case isset($dados['tecnico']):
       return $this->query()
       ->where('ativo', true)
       ->where('tecnico', 'like', '%'.$dados['tecnico'].'%')
       ->where('status', '!=', FECHADO)
       ->whereIn('unidade_id', $unidadesAtend)
       ->orderby('created_at', 'desc')
       ->paginate();
       break;  

       case is_null($dados['status']):
         return $this::where('ativo', true)
         ->where('status', '!=', FECHADO)
         ->whereIn('unidade_id', $unidadesAtend)
         ->paginate(); 
       break;        
      }
    }

    public function filtrarMeusChamados(array $dados)
   :object{
     
     $user = auth()->user()->id;

     switch ($dados) {
       case isset($dados['titulo']):
        return $this->query()
        ->where('titulo', 'like', '%'.$dados['titulo'].'%')
        ->orderby('status')
        ->orderby('created_at')
        ->paginate();
       break;

       case isset($dados['status']):
         return $this->query()
         ->where('status', $dados['status'])
         ->orderby('created_at', 'desc')
         ->paginate();
       break;

       case isset($dados['data']):
         $dt = date('d/m/Y', strtotime($dados['data']));
         return $this::where('ativo', true)
         ->where(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y")'), $dt)
         ->where('user_id', $user)
         ->paginate(); 
       break;

       default:
         return $this->query()
         ->orderby('status')
         ->orderby('created_at', 'desc')
         ->limit(30)
         ->paginate();

      }
    }

    public function movtoChamados():object{
      $movtos = DB::table('movtoChamados as m')
      ->join('chamados as c', 'c.id', 'm.chamado_id')
      ->select('m.chamado_id as id', 'm.titulo', 
       'm.status', 'c.data')
      ->where('c.data', date('Y/m/d'))
      ->orderby('m.chamado_id')
      ->orderby('created_at')
      ->orderby('m.status')
      ->limit(30)
      ->get();

      return $movtos;
    }

    public function searchTechnician(array $dados):bool{
      $query = 
      $this::where('tecnico', $dados['name'])
      ->where('unidade_id', $dados['unidade_id'])
      ->where('ativo', true)
      ->where('status', '<>', FECHADO)
      ->first();
           
      if(is_null($query))
        return false;
        
      return true;     
    }

    public function fecharChamado(array $dados):bool{
      $movto = $this->getUltimoMovto($dados['id']);

      try{
        $movto->status = FECHADO;
        $movto->save();
      }catch(\Exception $e){
        dd($e->getMessage());
        return false;
      }
      return true;

    }
}
