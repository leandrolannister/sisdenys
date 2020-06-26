<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserValidate;
use App\User;
use App\Models\{Unidade};
use App\Service\Helper;

class UsersController extends Controller
{
  public function index(){
    $userList = (new User())->list();
    $perfis = (new User())->perfis();

    return view('usuario.index', 
      compact('userList', 'perfis'));
  }

  public function create():object{
    $user = auth()->user();

    $unidadeList = (new Unidade())->list();

    return view('usuario.create', 
      compact('user', 'unidadeList'));
  }  
  
  public function update(UserValidate $req):object{       
    $updateUser = (new User())->update_u($req->all());

    if($updateUser)
      return redirect()->route('user.create')
      ->with('success', MENSAGEM_SUCESSO);    
    
        return redirect()->route('user.create')
        ->with('error', MENSAGEM_ERRO);
  }

  public function atualizaUsuarioComum(Request $req
  ):object{

    $this->validarUsuarioComum($req);

    $updateUser = (new User())
    ->updateUserComum($req->all()); 

    if($updateUser)
      return redirect()->route('user.create')
      ->with('success', MENSAGEM_SUCESSO); 

    return redirect()->route('user.create')
    ->with('error', MENSAGEM_ERRO);       
  }

  private function validarUsuarioComum(Request $req):void{
     $this->validate($req, [
      'name' => 'required|min:3',
      'email' => 'required']);   
  }

  public function edit(Request $req){
    $update = (new User())->updatePerfil($req->all());

    if($update)
      return redirect()->route('user.index')
      ->with('success', MENSAGEM_SUCESSO);    
    
      return redirect()->route('user.index')
      ->with('error', MENSAGEM_ERRO); 
  }
}
