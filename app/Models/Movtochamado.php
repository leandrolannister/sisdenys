<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movtochamado extends Model
{
   protected $fillable = ['titulo','tipo','status',
   'descricao','user_id', 'chamado_id'];

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   } 
}
