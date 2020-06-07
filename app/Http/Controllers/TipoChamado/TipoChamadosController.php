<?php

namespace App\Http\Controllers\TipoChamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Tipochamado\TipoValidate;
use App\Models\Tipochamado;

class TipoChamadosController extends Controller
{
    public function index(){
      $tipoList = (new Tipochamado())->list();

      return view('tipochamado.index', 
        compact('tipoList'));      
    }

    public function create():object{
      $tipoList = (new Tipochamado())->list();
      return view('tipochamado.create', 
        compact('tipoList'));      
    }

    public function store(TipoValidate $req):object{
       $create = (new Tipochamado())
       ->store_t($req->all()); 

       if($create)
        return redirect()->route('tipochamado.create')
        ->with('success', MENSAGEM_SUCESSO);

       return redirect()->route('tipochamado.create')
        ->with('error', MENSAGEM_SUCESSO); 
    }

    public function upgrade(int $id){
       $tipo = Tipochamado::find($id);
       
       return view('tipochamado.update', 
        compact('tipo'));
    }

    public function update(TipoValidate $req){
      $update = (new Tipochamado())->update_t($req->all());

      if($update)
        return redirect()->route('tipochamado.create')
        ->with('success', MENSAGEM_SUCESSO_UPDATE);

      return redirect()->route('tipochamado.create')
        ->with('error', MENSAGEM_ERRO_UPDATE);   
  
    }
}
