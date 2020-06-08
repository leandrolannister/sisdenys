<?php

namespace App\Http\Controllers\TipoUSuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\{Tipousuario, Instituicao};

class TipoUsuariosController extends Controller
{
    public function index():object {
       $usersList = (new User())->listar();
       $tiposUserList = Tipousuario::all();
       $instituicaoList = (new Instituicao())->list('id');
       $tipos = (new Tipousuario())->getTipos();
       
       return view('tipousuario.create', 
        compact('usersList', 'tipos', 'instituicaoList'));     		
    }

    public function store(Request $req){

      $create = (new Tipousuario())->storeBefore($req->all());
      
      if($create)
        return redirect()->route('tipousuario.index')
        ->with('success', MENSAGEM_SUCESSO);

       return redirect()->route('tipousuario.index')
        ->with('error', MENSAGEM_ERRO);      
    }

    public function getTipos():array{
      return ['Admin', 'Tecnico', 'Comum'];
    }

    public function delete():object{
       $usersList = (new User())->listToDestroy();
       $tiposUserList = Tipousuario::all();
       $instituicaoList = (new Instituicao())->list('id');
       $tipos = (new Tipousuario())->getTipos();
       
       return view('tipousuario.destroy', 
        compact('usersList', 'tipos', 'instituicaoList'));
    }

    public function destroy(Request $req){
      $destroy = (new Tipousuario())->destroy_t($req->all());

      if($destroy)
        return redirect()->route('tipousuario.delete')
        ->with('success', MESSAGE_DESTROY);

       return redirect()->route('tipousuario.delete')
        ->with('error', MESSAGE_DESTROY_USER_PERFIL);
    }

    public function filtro(Request $req){
      $usersList = (new User())->filtroTipoUsuario($req->name);

      $tiposUserList = Tipousuario::all();
      $instituicaoList = (new Instituicao())->list('id');
      $tipos = (new Tipousuario())->getTipos();
       
      return view('tipousuario.create', 
       compact('usersList', 'tipos', 'instituicaoList'));   
    }
}
