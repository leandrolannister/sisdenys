<?php 

namespace App\Service;

use App\Mail\Email;
use App\Models\Chamado;
use App\User;
use Illuminate\Support\Facades\Mail;

class Helper{

   public function enviaEmailUsuario():void{
     $chamado = (new Chamado())
     ->getUltimoChamadoUsuario();
      
     Mail::send(new Email($chamado->titulo, 
     auth()->user()->email,
     $chamado->id,'mail.chamado.user.novo'));
     
     $this->enviaEmailTecnicos($chamado);         
    }

    public function enviaEmailTecnicos(Chamado 
    	$chamado):void{
      
      $emails = (new User())
      ->getUsuariosGrupo($chamado->grupochamado_id);

      foreach($emails as $key => $e):
      	Mail::send(new Email($chamado->titulo, 
        $e->email,
        $chamado->id,'mail.chamado.tecnico.novo'));
      endforeach; 	
    }
}