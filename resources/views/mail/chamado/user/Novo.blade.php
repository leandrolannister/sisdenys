@component('mail::message')
  <h1> Mr(a) {{auth()->user()->name}}</h1>
  <h3>
  	Seu chamado {{$titulo}} foi aberto com sucesso.
  </h3>

  @component('mail::button', ['url' => ''])
    Acompanhar
  @endcomponent
@endcomponent