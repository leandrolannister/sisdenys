<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;
use Illuminate\Http\Request;

class Chamado extends Model
{
    protected $fillable = ['titulo', 'tipo', 
    'descricao','status','data', 
    'user_id', 'grupochamado_id'];

    public $timestamps = false;

    public function user():object {
    	return $this->belongsTo(User::class);
    }

    public function movtoChamados():object{
     return $this->hasMany(MovtoChamado::class);
    } 

    public function grupoChamado():object {
    	return $this->belongsTo(GrupoChamado::class);
    } 

    public function arquivos():object{
        return $this->hasMany(Arquivo::class);
    }

    public function store_c(Request $req): bool{      
      DB::beginTransaction();

      try{
        $dados = $req->all();
        $dados['user_id'] = auth()->user()->id;
        $dados['data'] = Date('Y:m:d');
        
        $chamado = $this::create($dados);
        
       }catch(\Exception $e){
         return false;
       }

       $movtoChamados = (new Movtochamado())
       ->store_mc($chamado, $dados);

       if($chamado and $movtoChamados):
         DB::commit();
         return true;
       endif;
       
       DB::rollback();
       return false;  
    }

    public function storeWithFile(Request $req):bool{
      DB::beginTransaction();

      try{
        $dados = $req->all();
        $dados['user_id'] = auth()->user()->id;
        $dados['data'] = Date('Y:m:d');
        
        $chamado = $this::create($dados);
        
       }catch(\Exception $e){
         return false;
       }

       $arquivo = (new Arquivo())
       ->store_a($req, $chamado);

       $movtoChamados = (new Movtochamado())
       ->store_mc($chamado, $dados);

       if($chamado and $arquivo and $movtoChamados):
         DB::commit();
         return true;
       endif;
       
       DB::rollback();
       return false;   
    }

    public function getUltimoChamadoUsuario():object{
      return $this::where('user_id',
      auth()->user()->id)->get()->last();
    }

    public function meusChamados(int $user_id):
    array{
       
      $meusChamados = DB::select("
        SELECT c.id AS id,
         (select m.titulo from movtochamados as m
          where m.chamado_id = c.id order by m.id 
          desc limit 1) AS Titulo, 
          
         (select m.tipo from movtochamados as m 
          where m.chamado_id = c.id order by m.id 
          desc limit 1) AS Tipo,
  
         (select m.status from movtochamados as m 
          where m.chamado_id = c.id order by m.id 
          desc limit 1) AS Status,
  
         (select m.descricao from movtochamados as 
          m where m.chamado_id = c.id order by m.id 
          desc limit 1) as Descricao,
          c.data AS Data
        FROM Chamados AS c
        WHERE c.user_id = $user_id");

        return $meusChamados;      
    }

}

