<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
  public $timestamps = false;
  protected $table = "instituicoes";
  protected $fillable = ['nome', 'sigla'];

  public function unidades():object {
     return $this->hasMany(Unidade::class);
  }

  public function setSiglaAttribute($sigla):void{
    $this->attributes['sigla'] = mb_strtoupper($sigla);
  }

  public function store_i(array $dados):bool{
    try{
      $this::create($dados);
    }catch(\Exception $e){
      return false;
    }
    return true;
  }

  public function list(string $campo):object{
    $instituicoes = $this::query()->orderby($campo)
    ->get();

    return $instituicoes;
  }

  public function update_i(array $dados):bool{
    $instituicao = self::find($dados['id']);
    try{
       $instituicao->fill($dados);
       $instituicao->save();
    }catch(\Exception $e){
      dd($e->getMessage());
      return false;
    }
    return true;
  }

}
