@component('mail::message')
  <h1> O Chamado: {{$titulo}} foi REABERTO</h1>
  
  @component('mail::button', ['url' => 
  TECNICO_URL])
    Atender
  @endcomponent
@endcomponent