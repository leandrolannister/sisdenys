<?php

namespace App\Http\Controllers\Instituicao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Instituicao\InstituicaoValidade;
use App\Models\Instituicao;

class InstituicoesController extends Controller
{
    public function index(){
      $instituicaoList = 
      (new Instituicao())->list('id');

      return view('instituicao.index', 
      compact('instituicaoList'));
    }

    public function create():object{
       return view('instituicao.create');	
    }

    public function store(InstituicaoValidade $req)
    :object{

      if((new Instituicao())->store_i($req->all()))
        return redirect()->route('instituicao.create')
        ->with('success', MENSAGEM_SUCESSO);

      return redirect()->route('instituicao.create')
      ->with('error', MENSAGEM_ERRO);  	
    }

    public function upgrade(int $id):object{
      $instituicao = Instituicao::find($id);

      return view('instituicao.update', 
        compact('instituicao'));  
    }

    public function update(InstituicaoValidade $req)
    :object{
       $update = (new Instituicao())
       ->update_i($req->all());

       if($update)
         return redirect()->route('instituicao.index')
        ->with('success', MENSAGEM_SUCESSO_UPDATE);
       
       return redirect()->route('instituicao.index')
      ->with('error', MENSAGEM_ERRO_UPDATE);  

    }

    
}
