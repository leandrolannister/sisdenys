@component('mail::message')
  <h1>Número Chamado: {{$chamado}}</h1>
  <h3>
  	O chamado {{$titulo}} foi aberto com sucesso.
  </h3>

  @component('mail::button', ['url' => 
  TECNICO_URL])
    Acompanhar
  @endcomponent
@endcomponent