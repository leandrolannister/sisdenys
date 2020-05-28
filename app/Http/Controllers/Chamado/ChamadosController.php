<?php

namespace App\Http\Controllers\Chamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{GrupoChamado, Chamado, Arquivo};

class ChamadosController extends Controller
{
    public function create(): object{
    	$grupoList = GrupoChamado::all();

    	return view('chamado.create', 
    		compact('grupoList'));
    }

    public function store(Request $req):object{

      $chamado = $req->arquivo 
      ?(new Chamado())->storeWithFile($req)
      :(new Chamado())->store_c($req); 

      if($chamado)
        return redirect()->route('chamado.create')
        ->with('success', CHAMADO_SUCESSO);  

      return redirect()->route('chamado.create')
      ->with('success', CHAMADO_ERRO);
    }
}
