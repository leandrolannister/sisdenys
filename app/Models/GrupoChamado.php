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

   public function store_g(array $dados):bool{
   	
   	try{
      $this::create($dados);
   	}catch(\Exception $e){
   		dd($e->getMessage());

   		return false;
   	}
   	return true;
   }

   public function setDescricaoAttribute($grupo): void{
     $this->attributes['descricao'] = mb_strtoupper($grupo);
   }

}
