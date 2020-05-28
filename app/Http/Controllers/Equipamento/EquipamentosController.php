<?php

namespace App\Http\Controllers\Equipamento;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipamento\EquipamentoValidate;
use Illuminate\Http\Request;
use App\Models\{Equipamento, Instituicao};

class EquipamentosController extends Controller
{
    public function index(){
    	echo "index";
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
}
