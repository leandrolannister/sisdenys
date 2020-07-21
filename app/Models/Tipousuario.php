<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tipousuario extends Model
{
  public $timestamps = false;
  protected $fillable = ['tipo', 'user_id', 'unidade_id'];
  private const ADMIN = 'Admin';
  private const TECNICO = 'Tecnico';
  
  public function user():object {
    return $this->belongsTo(User::class);
  }

  public function unidade():object {
    return $this->belongsTo(Unidade::class);
  }

  public function storeBefore(array $dados):bool{
     $data = $this->searchData($dados);

     if(is_null($data))
       return $this->store_t($dados); 

     if(!is_null($data))
       return $this->update_t($dados);     

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

  public function update_t(array $dados):bool{
        
    $tipousuario = $this::where('user_id', $dados['user_id'])
    ->select('id')
    ->first();

    $tipo = $this::find($tipousuario->id);    

    try{
      $tipo->fill($dados);
      $tipo->save();
    }catch(\Exception $e){
       dd($e->getMessage()); 
      return false;
    }
    return true;
  }
  
  public function searchData(array $dados)
  :?int{
     
     $query = 
     $this::where('user_id', $dados['user_id'])
     ->where('tipo', $dados['tipo'])
     ->where('unidade_id', $dados['unidade_id'])
     ->first();

     if(isset($query->id))
       return $query->id;

     return null;                   
  }

  public function destroy_t(array $dados):bool{
    $tecnico = (new Movtochamado())
    ->searchTechnician($dados);
    
    if($tecnico)
      return false;

    try{
      
      $tipousuario = $this::where('user_id', $dados['user_id'])
      ->select('id')
      ->first();      

      $this::destroy($tipousuario->id);
    }catch(\Exception $e){
      dd($e->getmessage());
      return false;
    }    
    return true;    
  }

  public function getTipos():array{
    return ['Tecnico', 'Admin'];
  }

  public function userType(int $user_id): bool{
      $user = $this::where('user_id', $user_id)
      ->select('tipo')
      ->first();

      if(is_null($user))
        return false;
          
      if($user->tipo == 'Tecnico' || $user->tipo == 'Admin')
        return true;
  }

}
