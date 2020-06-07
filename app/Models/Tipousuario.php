<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tipousuario extends Model
{
  public $timestamps = false;
  protected $fillable = ['tipo', 'user_id'];
  private const ADMIN = 'Admin';
  private const TECNICO = 'Tecnico';
  private const COMUM = 'Comum';

  public function user():object {
    return $this->belongsTo(User::class);
  }

  public function store_t(array $dados): bool{
    
    $tipo = $this::find($dados['user_id']);

    if($tipo->tipo == $dados['tipo'])
      return true; 

    if($tipo->tipo != $dados['tipo'])
      return $this->update_t($dados, $tipo->id);
    
    try{  
       
       $this::create($dados);       
    }catch(\Exception $e){
      dd($e->getMessage()); 
      return false; 
    }
    return true;
  }  

  public function update_t(array $dados, int $id):bool{
    $tipo = $this::find($id);    
    try{
      $tipo->fill($dados);
      $tipo->save();
    }catch(\Exception $e){
       dd($e->getMessage()); 
      return false;
    }
    return true;
  }

  public function seekType(int $user_id, string $tipo)
  :?int{
    
     $query = 
     $this::where('user_id', $user_id)
     ->where('tipo', $tipo)
     ->select('tipo')
     ->first();

     if(isset($query->id))
       return $query->id;

     return null;                   
  }

  public function getTipos():array{
    return ['Comum', 'Tecnico', 'Admin'];
  }

}
