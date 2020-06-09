<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
use Illuminate\Http\Request;

class Chamado extends Model
{
    protected $fillable = ['titulo', 'descricao',
    'status','data','user_id', 'tipochamado_id'];

    public $timestamps = false;

    protected $perPage = 1;

    public function user():object {
    	return $this->belongsTo(User::class);
    }

    public function movtoChamados():object{
     return $this->hasMany(MovtoChamado::class);
    }
    
    public function arquivos():object{
        return $this->hasMany(Arquivo::class);
    }

    public function tipochamado():object{
     return $this->belongsTo(TipoChamado::class);
   }

    public function setAttributeDescricao($desc):void{
    $this->attributes['descricao'] = 
    mb_strtoupper($desc);
   }

    public function store_c(Request $req):bool{      
      
      if(isset($req->arquivo))        
        DB::beginTransaction();

      try{
        $dados = $req->all();
        $dados['user_id'] = auth()->user()->id;
        $dados['data'] = Date('Y:m:d');
        
        $chamado = $this::create($dados);

       }catch(\Exception $e){
         return false;
       }

       $dados['unidade_id'] = auth()->user()->unidade->id;
       
       $dados['status'] = TECNICO;      
       $chamado->movtoChamados()->create($dados);

       $dados['ativo'] = false;
       $dados['status'] = 'ABERTO';
       $chamado->movtoChamados()->create($dados);

       if(isset($req->arquivo)){
         $arquivo = (new Arquivo())
         ->store_a($req, $chamado);

         if($chamado):
           DB::commit();
           return true;
         else:
           DB::rollback();
           return false;  
         endif;
       
         DB::rollback();
         return false;  
       }

       return true; 
    }    
    
    public function meusChamados(int $user_id):
    array{
       
      $meusChamados = DB::select("
        SELECT c.id AS id,
         (select m.titulo from movtochamados as m
          where m.chamado_id = c.id 
          order by m.created_at 
          desc limit 1) AS Titulo, 
          
         (select m.status from movtochamados as m 
          where m.chamado_id = c.id 
          order by m.created_at 
          desc limit 1) AS Status,
  
         (select m.descricao from movtochamados as 
          m where m.chamado_id = c.id 
          order by m.created_at 
          desc limit 1) AS Descricao,

          c.data AS Data
        FROM Chamados AS c
        WHERE c.user_id = $user_id");

        return $meusChamados;      
    } 

      
}

