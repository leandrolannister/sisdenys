@component('mail::message')
  <h1> O Chamado: {{$titulo}} foi reaberto</h1>
  
  @component('mail::button', ['url' => ''])
    Acompanhar
  @endcomponent
@endcomponent