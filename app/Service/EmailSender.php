<?php 

namespace App\Service;

use App\Mail\Email;
use App\Models\Chamado;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailSender{

   public function enviaEmailUsuario():void{
     $chamado = (new Chamado())
     ->getUltimoChamadoUsuario();
     
     self::sender($chamado->titulo, 
      auth()->user()->email, $chamado->id, 
      'mail.chamado.user.novo');
     
     $this->enviaEmailTecnicos($chamado);         
    }

    public function enviaEmailTecnicos(Chamado 
    	$chamado):void{
      
      $emails = (new User())
      ->getUsuariosGrupo($chamado->grupochamado_id);
      
      foreach($emails as $key => $e):
        self::sender($chamado->titulo, $e->email,
        $chamado->id, 'mail.chamado.tecnico.novo');  
      endforeach;	
    }

    public static function sender(String $titulo, 
    String $email, String $chamadoId, 
    String $viewpath):void{

      Mail::send(new Email($titulo, $email, 
                           $chamadoId, $viewpath));
    }
}