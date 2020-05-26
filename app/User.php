<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Equipamento;
use App\Models\Tipousuario;
use App\Models\Chamado;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function equipamento():object {
      return $this->belongsTo(Equipamento::class);
    }

    public function tipousuarios():object {
      return $this->hasMany(Tipousuario::class);
    }

    public function chamados():object{
        return $this->hasMany(Chamado::class);
    }

    public function update_u(array $dados): bool {
      
      try{        
        
        $user = self::find(auth()->user()->id);

        if(is_null($dados['password'])):
          unset($dados['password']);
        else:
          $user->password = Hash::make($dados['password']);
        endif;
               
        $user->name  = $dados['name'];
        $user->email = $dados['email'];
        $user->save(); 

      }catch(\Exception $e){
        return false;
        //dd($e->getMessage());
      }
      return true;      
    }

    public function listar():?object{
      
      $users = $this::query()->orderBy('id', 'desc')
      ->paginate();

      return $users;    
    }

}
