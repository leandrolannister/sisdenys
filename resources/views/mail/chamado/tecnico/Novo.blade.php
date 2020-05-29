@component('mail::message')
  <h1>Número Chamado: {{$chamado}}</h1>
  <h3>
  	Um novo chamado {{$titulo}} foi aberto.
  </h3>

  @component('mail::button', ['url' => ''])
    Acompanhar
  @endcomponent
@endcomponent