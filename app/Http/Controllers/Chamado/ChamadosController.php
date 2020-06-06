<?php

namespace App\Http\Controllers\Chamado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Chamado, Arquivo, Movtochamado, 
Tipochamado};
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
      
      $tipoList = (new Tipochamado())
      ->list();

      return view('chamado.create', 
        compact('tipoList'));    		
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
        'descricao' => 'required']);  
    }

    public function show(Request $req):object{      
      $chamado = (new Movtochamado())
      ->getUltimoChamado($req->chamado_id);

      $historico = (new Movtochamado())
      ->historicoChamado($chamado->chamado_id);

      $files = (new Arquivo())
      ->list($chamado->chamado_id);

      $tipoList = (new Tipochamado())->list();
      
      $statusAtual = 
      Helper::checkStatus($chamado->status);

      return view('chamado.show', 
      compact('chamado', 'statusAtual', 
        'historico', 'files', 'tipoList'));
    }

    public function atendimento():object{
      
      $chamados = (new Movtochamado())
      ->atendimentoChamado();

      if(empty($chamados[0]->id))
        return view('home');      

       $historico = (new Movtochamado())
      ->historicoChamado($chamados[0]->id);
      
      $helper = (new Helper());

      return view('chamado.atendimento', 
      compact('chamados', 'helper', 
        'historico'));     
    }

    public function atender(Request $req){

      $chamado = (new Movtochamado())->
      atenderChamado($req->movto_id)[0];

      $files = (new Arquivo())
      ->list($chamado->chamado_id);

      $historico = (new Movtochamado())
      ->historicoChamado($chamado->chamado_id);

      $tipoList = (new Tipochamado())->list();
  
      return view('chamado.atender', 
      compact('chamado', 'files', 
        'historico', 'tipoList'));
    }

    public function updateTecnico(Request $req)
    {
       $update = (new Movtochamado())
       ->updateTecnico($req->all());

       $tecnico = ['success' => $update];

       $update 
       ? $tecnico['message'] = 'Técnico atualizado'
       : $tecnico['message'] = 'Técnico não foi atualizado!
       ';
       
       echo json_encode($tecnico);
    }

    public function retornotecnico(Request $req)
    :object {

      //dd($req->all());

      if(is_null($req->atendimento))
        return redirect()->route('chamado.atendimento')
        ->with('error', CHAMADO_SEM_PARECER_TECNICO);
    
      
      $atendimento = $req->arquivo 
      ? (new Movtochamado())
        ->retornoTecnicoComArquivo($req)
      : (new Movtochamado())->retornotecnico($req);
       

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
      
      if(is_null($req->descricao))
        return redirect()->route('chamado.index')
        ->with('error', CHAMADO_SEM_DESCRICAO_USUARIO);

      $chamadoReaberto = (new movtoChamado())
      ->reabrirChamado($req);

      $movtoChamado = (new Movtochamado())
      ->getUltimoMovto($req->id);

      if($chamadoReaberto):
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

    public function filtro(Request $req)
    :object{
     
      $chamados = (new Movtochamado())
      ->filtrarAtendimento($req->all()); 
      
      $helper = (new Helper()); 

      $chamadosPaginate = $req->all();
      
      return view('chamado.atendimento', 
      compact('chamados','helper', 
        'chamadosPaginate')); 
    }

    public function filtrarMeusChamados(Request $req)
    {
       $chamados = (new Movtochamado())
      ->filtrarMeusChamados($req->all()); 
      
      $helper = (new Helper()); 

      $chamadosPaginate = $req->all();
      
      return view('chamado.atendimento', 
      compact('chamados','helper', 
        'chamadosPaginate'));  
    }

    public function movtoChamado(){
      $chamados = (new Movtochamado())
      ->movtoChamados();

      return view('chamado.movto', 
      compact('chamados'));
    }
}
