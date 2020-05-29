<?php

namespace App\Http\Controllers\Chamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{GrupoChamado, Chamado, Arquivo};
use App\Mail\Email;
use App\Service\EmailSender;
use Illuminate\Support\Facades\Mail;

class ChamadosController extends Controller
{
    public function create(): object{
    	$grupoList = GrupoChamado::all();

    	return view('chamado.create', 
    		compact('grupoList'));
    }

    public function store(Request $req):object{

      $this->validar($req);

      $chamadoAberto = $req->arquivo 
      ?(new Chamado())->storeWithFile($req)
      :(new Chamado())->store_c($req); 

      if($chamadoAberto):
        (new EmailSender())->enviaEmailUsuario();  
        
        return redirect()->route('chamado.create')
        ->with('success', CHAMADO_SUCESSO);  
      endif;  

      return redirect()->route('chamado.create')
      ->with('success', CHAMADO_ERRO);
    }    

    private function validar(Request $req):void{
      $this->validate($req, [
        'titulo' => 'required',
        'grupochamado_id' => 'required',
        'descricao' => 'required']);  
    }
}
