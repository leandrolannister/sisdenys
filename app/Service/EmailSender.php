<?php 

namespace App\Service;

use App\Mail\Email;
use App\Models\{Chamado, Movtochamado};
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailSender{

   private const VIEW_PATH_EMAIL_USER = 
   'mail.chamado.user.novo';

   private const VIEW_PATH_EMAIL_TECHNICIAN = 
   'mail.chamado.tecnico.novo';  

   public function enviaEmailUsuario():void{
     $chamado = (new Chamado())
     ->getUltimoChamadoUsuario();
     
     self::sender($chamado->titulo, 
      auth()->user()->email, $chamado->id, 
      self::VIEW_PATH_EMAIL_USER);
     
     $this->enviaEmailTecnicos($chamado);         
    }

    public function enviaEmailTecnicos(Chamado 
    	$chamado):void{
      
      $emails = (new User())
      ->getUsuariosGrupo($chamado->grupochamado_id);
      
      foreach($emails as $key => $e):
        self::sender($chamado->titulo, $e->email,
        $chamado->id, 
        self::VIEW_PATH_EMAIL_TECHNICIAN);  
      endforeach;	

      $this->atualizaStatusChamado($chamado->id);
    }

    public static function sender(String $titulo, 
    String $email, Int $chamadoId, 
    String $viewpath):void{

      Mail::send(new Email($titulo, $email, 
                           $chamadoId, $viewpath));
    }

    public function atualizaStatusChamado(int 
      $chamadoId):void{
      
      (new Movtochamado())
      ->atualizaStatusChamado($chamadoId, TECNICO);
    }
}