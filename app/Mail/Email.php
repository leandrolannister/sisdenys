<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    private $titulo;
    private $destinatario;
    private $numeroChamado;
    private $viewpath;
       
    public function __construct(String $titulo, String $destinatario, String $numeroChamado,
      String $viewpath){

      $this->titulo = $titulo;
      $this->destinatario = $destinatario;
      $this->numeroChamado = $numeroChamado;
      $this->viewpath = $viewpath;
    }

    public function build()
    {      
      $this->subject($this->titulo);
      $this->from(env('MAIL_USERNAME'));
      $this->to($this->destinatario);
      
      return $this->markdown($this->viewpath,[
      'titulo' => $this->titulo,
      'chamado' => $this->numeroChamado]);
    }    
}
