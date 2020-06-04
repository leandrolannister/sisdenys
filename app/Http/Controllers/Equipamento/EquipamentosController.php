<?php

namespace App\Http\Controllers\Equipamento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipamento\EquipamentoValidate;
use Illuminate\Http\Request;
use App\Models\{Equipamento, Instituicao};

class EquipamentosController extends Controller
{
    public function index(){
      $equipamentoList = (new Equipamento())->list();
     
      return view('equipamento.index', 
        compact('equipamentoList'));
    }

    public function create():object{
      $instituicoes = (new Instituicao())->list('id');

      return view('equipamento.create',
      	compact('instituicoes'));
    }

    public function store(EquipamentoValidate $req):object{
   
      if((new Equipamento())->store_e($req->all()))
        return redirect()
        ->route('equipamento.create')
        ->with('success', MENSAGEM_SUCESSO);

      return redirect()->route('equipamento.create')
      ->with('error', MENSAGEM_ERRO);
    }

    public function upgrade(int $id):object{
      $equipamento = Equipamento::find($id);
       $instituicoes = (new Instituicao())->list('id');

      return view('equipamento.update',
      compact('equipamento', 'instituicoes'));
    }

    public function update(EquipamentoValidate $req){
       $update = (new Equipamento())
       ->update_e($req->all());

       if($update)
         return redirect()->route('equipamento.index')
        ->with('success', MENSAGEM_SUCESSO_UPDATE);
       
       return redirect()->route('equipamento.index')
      ->with('error', MENSAGEM_ERRO_UPDATE);   
       
    }
}
