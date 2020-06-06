<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoChamado extends Model
{
    protected $fillable = ['descricao'];
    public $timestamps = false;
    protected $table = "tipochamados";

    public function chamados():object{
    	return $this->hasMany(Chamado::class);
    }

    public function movtochamados():object{
    	return $this->hasMany(Movtochamados::class);
    }

    public function setDescricaoAttribute($desc):void{
        $this->attributes['descricao'] 
        = mb_strtoupper($desc);
    }

    public function store_t(array $dados):bool{
    	try{
           $this::create($dados);
    	}catch(\Exception $e){
    		dd($e->getMessage());
    		return false;
    	}
    	return true;
    }

    public function list():object{
        return 
        $this::all()->sortByDesc('id');
    }

    public function update_t(array $dados):bool{
        $tipo = $this::find($dados['id']);

        try{
            $tipo->fill($dados);
            $tipo->save();
        }catch(\Exception $e){
            dd($e->getMessage());
            return false;
        }
        return true;
    }
}
