<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoChamado extends Model
{
   protected $fillable = ['nome'];

   public function chamados(): object{
      return $this->hasMany(Chamado::class);	
   }

}
