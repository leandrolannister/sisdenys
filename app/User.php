<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Unidade;
use App\Models\Tipousuario;
use App\Models\Chamado;
use Illuminate\Support\Facades\Hash;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email',
    'password', 'unidade_id'];

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

    protected $perPage = 10;

    public function unidade():object {
      return $this->belongsTo(Unidade::class);
    }

    public function tipousuarios():object {
      return $this->hasMany(Tipousuario::class);
    }

    public function chamados():object{
        return $this->hasMany(Chamado::class);
    }
    
    public function update_u(array $dados):bool{
      try{

        $user = self::find(auth()->user()->id);

        if(is_null($dados['password'])):
          unset($dados['password']);
        else:
          $user->password = 
          Hash::make($dados['password']);
        endif;

        $user->name  = $dados['name'];
        $user->email = $dados['email']; 
        $user->unidade_id = $dados['unidade_id'];       
        $user->save();

      }catch(\Exception $e){
        dd($e->getMessage());
        return false;
      }
      return true;
    }
    
    public function listar():?object{
     $users = 
     DB::table('users as u')
     ->leftjoin('tipousuarios as t', 't.user_id', 'u.id')
     ->select('u.id', 'u.name', 't.tipo', 't.instituicao_id')
     ->orderby('u.name')
     ->paginate();

      return $users;
    }

    public function listToDestroy():?object{
     $users = 
     DB::table('users as u')
     ->join('tipousuarios as t', 't.user_id', 'u.id')
     ->select('u.id', 'u.name', 't.tipo', 't.instituicao_id')
     ->orderby('u.name')
     ->paginate();

      return $users;
    }

    public function filtroTipoUsuario(string $name):?object{
     $users = 
     DB::table('users as u')
     ->leftjoin('tipousuarios as t', 't.user_id', 'u.id')
     ->select('u.id', 'u.name', 't.tipo', 't.instituicao_id')
     ->where('u.name', 'like', "%$name%")
     ->orderby('u.name')
     ->paginate();

      return $users;
    }

    public function getUsuariosGrupo(
    int $grupochamado_id):object{

      return $this::where('grupochamado_id',
      $grupochamado_id)->select('email')
      ->get();
    }
}
