<?php

namespace App\Http\Controllers\TipoUSuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Tipousuario;

class TipoUsuariosController extends Controller
{
    public function index():object {
       $usersList = (new User())->listar();
       $tipousuario = (new Tipousuario());       

       return view('tipousuario.create', 
    		compact('usersList', 'tipousuario'));
    }

    public function store(Request $req){
      //dd($req->all());
      (new Tipousuario())->store_t($req->all());

      return redirect()->route('tipousuario.index')
      ->with('success', MENSAGEM_SUCESSO);
    }
}
