<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use User;

class Unidade extends Model
{
  public $timestamps = false;
  protected $fillable = ['nome', 'logradouro', 'numero',
    'bairro', 'cep', 'complemento', 'instituicao_id'];

  public function instituicao():object {
     return $this->belongsTo(Instituicao::class);
  }

  public function users():object {
  	return $this->hasMany(User::class);
  }

  public function store_e(array $dados):bool{
    try{
      $this::create($dados);
    }catch(\Exception $e){
      return false;
    }

    return true;
  }

  public function list():object{
    $Unidades = $this::query()->orderBy('id', 'desc')
    ->get();

    return $Unidades;
  }

  public function setCepAttribute($cep){
    $this->attributes['cep'] = str_replace('-', '', $cep);
  }

  public function update_e(array $dados):bool{
    $Unidade = self::find($dados['id']);
    try{
      $Unidade->fill($dados);
      $Unidade->save();
    }catch(\Exception $e){
      dd($e->getMessage());
      return false;
    }
    return true;
  }
}
