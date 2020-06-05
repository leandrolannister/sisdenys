<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use App\Service\Helper;

class Movtochamado extends Model
{
   protected $fillable = ['titulo','tipo','status',
   'descricao','user_id', 'chamado_id', 
   'grupochamado_id','atendimento', 'tecnico',
   'ativo'];

   protected $perPage = 8;

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   }

   public function grupoChamado():object {
     return $this->belongsTo(GrupoChamado::class);
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

   public function atendimentoChamado(int $grupochamado_id):object{
         
     $chamados = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id', 'm.tipo',
      'm.status', 'm.descricao', 'm.created_at',
      'm.titulo', 'u.name', 'm.id', 'm.tecnico')
      ->where('ativo', true)
      ->where('m.status', '<>', FECHADO)
      ->where('m.grupochamado_id', $grupochamado_id)
      ->paginate($this->perPage);
    
     return $chamados;
   }

   public function atenderChamado(int $movto_id)
   :object{

     $chamado = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id', 'm.tipo',
      'm.status', 'm.descricao', 'm.created_at',
      'm.titulo', 'm.id', 'm.grupochamado_id', 
      'u.email')
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
     
       $movto = Movtochamado::where('id', 
       $req->movtoId)->orderby('id','desc')
       ->first();

       $movto->ativo = false;
       $movto->save();
              
       Movtochamado::create([
         "titulo" => $movto->titulo,
         "tipo" => $movto->tipo,
         "status" => FECHADO,
         "descricao" => $movto->descricao,
         "user_id" => $movto->user_id,
         "atendimento" => $req->atendimento,
         "tecnico" => auth()->user()->name,
         "chamado_id" => $movto->chamado_id,
         "grupochamado_id" => $movto->grupochamado_id
        ]);

      }catch(\Exception $e){ 
        dd($e->getMessage());       
        $chamado = ['id' => $movto->chamado_id,
                    'result' => false];

        return $chamado;
      }
      
      $chamado = ['id' => $movto->chamado_id,
                  'result' => true];

      return $chamado;
   }

   public function retornoTecnicoComArquivo(
   Request $req): array{

      try{
        $movto = Movtochamado::where('id', 
        $req->movtoId)->orderby('id','desc')
        ->first();
        
        $movto->ativo = false;
        $movto->save();

        Movtochamado::create([
           "titulo" => $movto->titulo,
           "tipo" => $movto->tipo,
           "status" => FECHADO,
           "descricao" => $movto->descricao,
           "user_id" => $movto->user_id,
           "atendimento" => $req->atendimento,
           "tecnico" => auth()->user()->name,
           "chamado_id" => $movto->chamado_id,
           "grupochamado_id" => $movto->grupochamado_id
        ]);

      }catch(\Exception $e){ 
        dd($e->getMessage());       
        
        return ['id' => $movto->chamado_id,
                'result' => false];        
      }
      
      $arquivo = (new Arquivo())
      ->store_a($req, $movto->chamado);

      if($movto and $arquivo):
        DB::commit();
        return ['id' => $movto->chamado_id,
                'result' => true];
      endif;
       
      DB::rollback();
       
      return ['id' => $movto->chamado_id,
              'result' => false];  
   }

   public function historicoChamado(int $chamado_id)
   :object{
     
     $historico = 
     $this::where('chamado_id',$chamado_id)
     ->select('created_at', 'descricao', 
     'atendimento')->get();

     return $historico;
   }

   public function reabrirChamado(Request $req)
   :bool{
      
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
           "chamado_id" =>  $movto->chamado_id,
           "grupochamado_id" =>  $movto->grupochamado_id
        ]);   
      }catch(Exception $e){
        return false;
      } 

      $arquivo = (new Arquivo())
      ->store_a($req, $movto->chamado);

      if($newmovto and $arquivo):
        DB::commit();
        return true;
      endif;
       
      DB::rollback(); 
      return false;
   }

   public function filtrarAtendimento(array $dados)
   :object{
     
     $grupo = auth()->user()->grupochamado_id;

     switch ($dados) {
       case isset($dados['titulo']):
        return $this->query()
        ->where('ativo', true)
        ->where('titulo', 'like', '%'.$dados['titulo'].'%')
        ->where('status', '!=', FECHADO)
        ->where('grupoChamado_id', $grupo)
        ->orderby('created_at', 'desc')
        ->paginate();
       break;

       case isset($dados['status']):
         return $this->query()
         ->where('ativo', true)
         ->where('status', $dados['status'])
         ->where('status', '!=', FECHADO)
         ->where('grupoChamado_id', $grupo)
         ->orderby('created_at', 'desc')
         ->paginate();
       break;

       case isset($dados['data']):
         $dt = date('d/m/Y', strtotime($dados['data']));
         return $this::where('ativo', true)
         ->where(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y")'), $dt)
         ->where('status', '!=', FECHADO)
         ->where('grupoChamado_id', $grupo)
         ->paginate(); 
       break;  

      case isset($dados['name']):
       return DB::table('movtoChamados as m')
        ->join('users as u', 'u.id', 'm.user_id')
        ->select('m.id', 'm.titulo', 'm.status', 'm.chamado_id as chamado_id','m.created_at', 'u.name', 'm.tecnico')
        ->where('u.name', 'like', '%'.$dados['name'].'%')
        ->where('m.ativo', true)
        ->where('status', '!=', FECHADO)
        ->where('grupoChamado_id', $grupo)
        ->paginate(); 
       break; 

      case isset($dados['tecnico']):
       return $this->query()
       ->where('ativo', true)
       ->where('tecnico', 'like', '%'.$dados['tecnico'].'%')
       ->where('status', '!=', FECHADO)
       ->where('grupoChamado_id', $grupo)
       ->orderby('created_at', 'desc')
       ->paginate();
       break;  

       case is_null($dados['status']):
         return $this::where('ativo', true)
         ->where('status', '!=', FECHADO)
         ->where('grupoChamado_id', $grupo)
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
        ->where('ativo', true)
        ->where('titulo', 'like', '%'.$dados['titulo'].'%')
        ->where('user_id', $user)
        ->orderby('created_at', 'desc')
        ->paginate();
       break;

       case isset($dados['status']):
         return $this->query()
         ->where('ativo', true)
         ->where('status', $dados['status'])
         ->where('user_id', $user)
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

      }
    }
}
