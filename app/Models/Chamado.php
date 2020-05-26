<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Chamado extends Model
{
    protected $fillable = ['titulo', 'tipo', 'grupochamado_id',
    'descricao','status','data', 'user_id', 'grupochamado_id'];

    public function user():object {
    	return $this->belongsTo(User::class);
    }

    public function movtoChamados():object{
     return $this->hasMany(MovtoChamados::class);
    } 

    public function grupoChamado():object {
    	return $this->belongsTo(GrupoChamado::class);
    } 

    public function store_c(array $dados){
        //dd($dados);
        try{
           $dados['user_id'] = auth()->user()->id; 
           $dados['data'] = Date('Y:m:d');

           $this::create($dados);
        }catch(\Exception $e){
            dd($e->getMessage());
            return false;
        }
        return true;
    }
}

