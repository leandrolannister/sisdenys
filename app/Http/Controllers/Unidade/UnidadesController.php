<?php

namespace App\Http\Controllers\Unidade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unidade\UnidadeValidate;
use Illuminate\Http\Request;
use App\Models\{Unidade, Instituicao};

class UnidadesController extends Controller
{
    public function index(){
      $unidadeList = (new Unidade())->list();
     
      return view('unidade.index', 
        compact('unidadeList'));
    }

    public function create():object{
      $instituicoes = (new Instituicao())->list('id');

      return view('unidade.create',
      	compact('instituicoes'));
    }

    public function store(UnidadeValidate $req):object{
   
      if((new Unidade())->store_e($req->all()))
        return redirect()
        ->route('unidade.create')
        ->with('success', MENSAGEM_SUCESSO);

      return redirect()->route('unidade.create')
      ->with('error', MENSAGEM_ERRO);
    }

    public function upgrade(int $id):object{
      $unidade = Unidade::find($id);
       $instituicoes = (new Instituicao())->list('id');

      return view('unidade.update',
      compact('unidade', 'instituicoes'));
    }

    public function update(UnidadeValidate $req){
       $update = (new Unidade())
       ->update_e($req->all());

       if($update)
         return redirect()->route('unidade.index')
        ->with('success', MENSAGEM_SUCESSO_UPDATE);
       
       return redirect()->route('unidade.index')
      ->with('error', MENSAGEM_ERRO_UPDATE);   
       
    }
}
