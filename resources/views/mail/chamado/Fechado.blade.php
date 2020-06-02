@component('mail::message')
  <h1> Mr(a) Usuário</h1>
  <h3>
  	O chamado {{$titulo}} foi atendido com sucesso.
  </h3>

  @component('mail::button', ['url' => ''])
    Acompanhar
  @endcomponent
@endcomponent