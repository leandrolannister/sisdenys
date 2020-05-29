<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoChamado extends Model
{
   protected $fillable = ['descricao'];
   protected $table = "GrupoChamados";
   public $timestamps = false;

   public function chamados(): object{
      return $this->hasMany(Chamado::class);	
   }

   public function MovtoChamado(): object{
      return $this->hasMany(MovtoChamado::class); 
   }

   public function usuarios():object{
      return $this->hasMany(Usuario::class);
   }

   public function store_g(array $dados):bool{
   	
   	try{
      $this::create($dados);
   	}catch(\Exception $e){
   		return false;
   	}
   	return true;
   }

   public function setDescricaoAttribute($grupo): void{
     $this->attributes['descricao'] = mb_strtoupper($grupo);
   }

   

}
