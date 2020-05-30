<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movtochamado extends Model
{
   protected $fillable = ['titulo','tipo','status',
   'descricao','user_id', 'chamado_id', 
   'grupochamado_id'];

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   }

   public function grupoChamado():object {
     return $this->belongsTo(GrupoChamado::class);
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
}
