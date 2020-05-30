<?php

namespace App\Http\Controllers\Chamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{GrupoChamado, Chamado, Arquivo, Movtochamado};
use App\Mail\Email;
use App\Service\{Helper,EmailSender};
use Illuminate\Support\Facades\Mail;

class ChamadosController extends Controller
{
    public function index():object{
      
      $chamados = (new Chamado())
      ->meusChamados(auth()->user()->id);
      
      $helper = (new Helper());

      return view('chamado.index', 
        compact('chamados', 'helper'));       
    }

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

    public function show(Request $req):object{      
      $chamado = Movtochamado::where('id', 
      $req->chamado_id)->orderBy('id', 'desc')
      ->get()->last();
      
      $grupoList = GrupoChamado::all();

      $statusAtual = 
      Helper::checkStatus($chamado->status);
      
      return view('chamado.show', 
        compact('chamado', 'grupoList', 
                'statusAtual'));
    }

    public function atendimento():object{
      $chamados = (new Movtochamado())
      ->atendimentoChamado(
        auth()->user()->grupochamado_id);

      //dd($chamados);

      $helper = (new Helper());

      return view('chamado.atendimento', 
      compact('chamados', 'helper'));     
    }
}
