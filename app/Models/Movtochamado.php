<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movtochamado extends Model
{
   protected $fillable = ['tipo','status','descricao'
    'data', 'observacao', 'user_id'];

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   } 
}
