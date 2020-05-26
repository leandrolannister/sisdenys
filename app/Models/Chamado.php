<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Chamado extends Model
{
    protected $fillable = ['titulo','descricao','status',
    'data', 'user_id', 'grupoChamado_id'];

    public function user():object {
    	return $this->belongsTo(User::class);
    }

    public function movtoChamados():object{
     return $this->hasMany(MovtoChamados::class);
    } 

    public function grupoChamado():object {
    	return $this->belongsTo(GrupoChamado::class);
    } 
}

