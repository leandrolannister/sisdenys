<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tipousuario extends Model
{
  public $timestamps = false;
  protected $fillable = ['descricao', 'user_id'];
  protected $perPage = 1;
  private const ADMIN = 'Admin';
  private const TECNICO = 'Tecnico';
  private const COMUM = 'Comum';


  public function user():object {
    return $this->belongsTo(User::class);
  }

  public function store_t(array $dados):void {
     
     if(empty($dados['Admin'])):
       $this::destroy(
         $this->seekType($dados['user_id'], self::ADMIN));
     else:
       $this->create_t($dados['user_id'], $dados['Admin']);
     endif;

     if(empty($dados['Tecnico'])):
       $this::destroy(
         $this->seekType($dados['user_id'], self::TECNICO));
     else:
       $this->create_t($dados['user_id'], 
                       $dados['Tecnico']);
     endif;  

     if(empty($dados['Comum'])):
       $this::destroy(
         $this->seekType($dados['user_id'], self::COMUM));
     else:
       $this->create_t($dados['user_id'], 
                       $dados['Comum']);
     endif;
  }

  public function create_t($user_id, $desc): void{
    try{  
       $this::create(['descricao' => $desc,
                      'user_id'   => $user_id]);  
    }catch(\Exception $e){
      echo $e->getMessage();  
    }
  }

  public function seekType(int $user_id, string $type): ?int
  {
     $query = 
     $this::where('user_id', $user_id)
     ->select('id')
     ->where('descricao', $type)
     ->first();

     if(isset($query->id))
       return $query->id;

     return null;                   
  }

}
