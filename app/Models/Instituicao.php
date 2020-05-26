<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
  public $timestamps = false;
  protected $table = "instituicoes";
  protected $fillable = ['nome', 'sigla'];

  public function equipamentos():object {
     return $this->hasMany(Equipamento::class);	
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

}
