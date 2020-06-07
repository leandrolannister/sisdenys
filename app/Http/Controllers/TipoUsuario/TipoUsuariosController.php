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
       $tipoList = (new Tipousuario())->getTipos();

       return view('tipousuario.create', 
    		compact('usersList', 'tipoList'));
    }

    public function store(Request $req){
      $create = (new Tipousuario())->store_t($req->all());

      if($create)
        return redirect()->route('tipousuario.index')
        ->with('success', MENSAGEM_SUCESSO);

       return redirect()->route('tipousuario.index')
        ->with('error', MENSAGEM_SUCESSO);       
    }

    public function getTipos():array{
      return ['Admin', 'Tecnico', 'Comum'];
    }
}
