<?php

namespace App\Http\Controllers\GrupoChamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GrupoChamado;
use App\Http\Requests\GrupoChamado\GrupoValidate;

class GrupoChamadosController extends Controller
{
    public function index()
    {
    	echo "index";
    }

    public function create(): object{
      return view('GrupoChamado.create');
    }

    public function store(GrupoValidate $req): object{
    
       if((new GrupoChamado())->store_g($req->all()))
        return redirect()->route('grupochamado.create')
        ->with('success', MENSAGEM_SUCESSO);

       return redirect()->route('grupochamado.create')
       ->with('error', MENSAGEM_ERRO);	
    }
}
