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
    	$grupoList = (new GrupoChamado())->list();
            
      return view('grupochamado.index', 
        compact('grupoList'));
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

    public function upgrade(int $id):object{
       $grupochamado = GrupoChamado::find($id);
       
       return view('grupochamado.update', 
       compact('grupochamado'));
    }

    public function update(GrupoValidate $req):object{
      $update  = (new GrupoChamado())
      ->update_g($req->all());

      if($update)
         return redirect()->route('grupochamado.index')
        ->with('success', MENSAGEM_SUCESSO_UPDATE);
       
       return redirect()->route('grupochamado.index')
      ->with('error', MENSAGEM_ERRO_UPDATE); 

    }
}
