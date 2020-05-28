<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserValidate;
use App\User;
use App\Models\{GrupoChamado};

class UsersController extends Controller
{
  public function create():object 
  {
    $user = auth()->user();
    $grupoList = GrupoChamado::all();

    return view('usuario.create', 
      compact('user', 'grupoList'));
  }

  public function update(UserValidate $req):object
  {       
    if((new User())->update_u($req->all()))
    return redirect()->route('user.create')
    ->with('success', MENSAGEM_SUCESSO);    
    
    return redirect()->route('user.create')
      ->with('error', MENSAGEM_ERRO);
  }
}
