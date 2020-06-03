<?php

namespace App\Http\Controllers\Chamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{GrupoChamado, Chamado, 
                Arquivo, Movtochamado};
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
      $chamado = (new Movtochamado())
      ->getUltimoChamado($req->chamado_id);

      $historico = (new Movtochamado())
      ->historicoChamado($chamado->chamado_id);
      
      $grupoList = GrupoChamado::all();

      $statusAtual = 
      Helper::checkStatus($chamado->status);
      
      return view('chamado.show', 
      compact('chamado', 'grupoList', 
              'statusAtual', 'historico'));
    }

    public function atendimento():object{
      
      if(empty(auth()->user()->grupochamado_id))
        return view('home');

      $chamados = (new Movtochamado())
      ->atendimentoChamado(auth()->user()->grupochamado_id);
      
      $helper = (new Helper());

      return view('chamado.atendimento', 
      compact('chamados', 'helper'));     
    }

    public function atender(Request $req){
      $chamado = (new Movtochamado())->
      atenderChamado($req->movto_id)[0];

      $files = (new Arquivo())
      ->list($chamado->chamado_id);

      $historico = (new Movtochamado())
      ->historicoChamado($chamado->chamado_id);

      $grupoList = GrupoChamado::all();
      
      return view('chamado.atender', 
      compact('chamado', 'grupoList', 
        'files', 'historico'));
    }

    public function updateTecnico(Request $req)
    {
       $update = (new Movtochamado())
       ->updateTecnico($req->all());

       $tecnico = ['success' => $update];

       $update 
       ? $tecnico['message'] = 'Técnico atualizado'
       : $tecnico['message'] = 'Técnico não foi atualizado!';
       
       echo json_encode($tecnico);
    }

    public function retornotecnico(Request $req)
    :object {
       $atendimento = 
       (new Movtochamado())->retornotecnico($req);

      if($atendimento['result']):
        (new EmailSender())
        ->enviaEmailChamadoFechado(
          $atendimento['id']);

        return redirect()->route('chamado.atendimento')
        ->with('success', CHAMADO_ATENDIMENTO_SUCESSO);
      endif;  

      return redirect()->route('chamado.atendimento')
        ->with('success', CHAMADO_ATENDIMENTO_ERRO);
    }

    public function reabrirchamado(Request $req)
    :object {

      $movtoChamado = (new Movtochamado())
      ->getUltimoChamado($req->id);

      $movtoChamado->descricao = $req->descricao;

      $chamadoAberto = (new Movtochamado())
      ->reabrirChamado($movtoChamado);

      if($chamadoAberto):
        (new EmailSender())->enviaEmailTecnico(
          $movtoChamado->titulo,
          $movtoChamado->tecnico,
          $movtoChamado->chamado_id);

        return redirect()
        ->route('chamado.index')
        ->with('success', CHAMADO_REABERTO_SUCESSO);
      endif;

      return redirect()
        ->route('chamado.index')
        ->with('success', CHAMADO_REABERTO_ERRO);
    }
}
