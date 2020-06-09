@component('mail::message')
  <h1> Sr(a) {{auth()->user()->name}}</h1>
  <h3>
  	Seu chamado {{$titulo}} foi ABERTO com sucesso.
  </h3>

  @component('mail::button', ['url' => 
    USUARIO_URL])
    Acompanhar
  @endcomponent
@endcomponent