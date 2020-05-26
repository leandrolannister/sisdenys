<?php

namespace App\Http\Controllers\Instituicao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Instituicao\InstituicaoValidade;
use App\Models\Instituicao;

class InstituicoesController extends Controller
{
    public function index(){
      echo "instituicao";
    }

    public function create(){
       return view('instituicao.create');	
    }

    public function store(InstituicaoValidade $req){

      if((new Instituicao())->store_i($req->all()))
        return redirect()->route('instituicao.create')
        ->with('success', MENSAGEM_SUCESSO);

      return redirect()->route('instituicao.create')
      ->with('error', MENSAGEM_ERRO);  	
    }

    
}
