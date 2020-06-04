<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use User;

class Equipamento extends Model
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
    $equipamentos = $this::query()->orderBy('id', 'desc')
    ->get();

    return $equipamentos;
  }

  public function setCepAttribute($cep){
    $this->attributes['cep'] = str_replace('-', '', $cep);
  }

  public function update_e(array $dados):bool{
    $equipamento = self::find($dados['id']);
    try{
      $equipamento->fill($dados);
      $equipamento->save();
    }catch(\Exception $e){
      dd($e->getMessage());
      return false;
    }
    return true;
  }
}
