@component('mail::message')
  <h1> Mr(a) Técnico O Chamado: {{$chamado}}</h1>
  <h3>
  	Um NOVO chamado {{$titulo}} foi aberto.
  </h3>

  @component('mail::button', ['url' => 
    TECNICO_URL])
    Atender
  @endcomponent
@endcomponent