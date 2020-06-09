@component('mail::message')
  <h1> Sr(a) Usuário</h1>
  <h3>
  	O chamado {{$titulo}} foi ATENDIDO com sucesso.
  </h3>

  @component('mail::button', ['url' => 
   USUARIO_URL])
    Acompanhar
  @endcomponent
@endcomponent