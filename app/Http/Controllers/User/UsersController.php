<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserValidate;
use App\User;

class UsersController extends Controller
{
  public function create():object 
  {
    $user = auth()->user();

    return view('usuario.create', compact('user'));
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
