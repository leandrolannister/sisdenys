<?php

namespace App\Http\Controllers\Chamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GrupoChamado;
use App\Models\Chamado;

class ChamadosController extends Controller
{
    public function create(): object{
    	$grupoList = GrupoChamado::all();

    	return view('chamado.create', 
    		compact('grupoList'));
    }

    public function store(Request $req){

      if((new Chamado())->store_c($req->all()))
        return redirect()->route('chamado.create')
        ->with('success', MENSAGEM_SUCESSO);

      return redirect()->route('chamado.create')
      ->with('error', MENSAGEM_ERRO);	
    }
}
