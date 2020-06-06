@extends('adminlte::page')

@section('title', 'Chamado')

@section('content_header')
  <h1>Consulta Chamado</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('chamado.store')}}" 
          method="post"
          enctype="multipart/form-data">
          @csrf      
      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" 
               class="form-control"
               value="{{$chamado->titulo}}"
               <?=$statusAtual?>>         
      </div>      
      <div>
        <label name="status">Status</label>
        <input type="" name="status" 
               value="{{$chamado->status}}" 
               class="form-control"
               <?=$statusAtual?>>
      </div>         

      <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" class="form-control"
                <?=$statusAtual?>>
          <option value="Normal" 
          <?=$chamado->tipo == 'Normal' 
           ?'selected':''?>>Normal</option>
          
          <option value="Urgente"
          <?=$chamado->tipo == 'Urgente' 
           ?'selected':''?>>Urgente</option> 
        </select>          
      </div>
      @include('chamado.historico')
      @include('chamado.arquivos')
    </form> 
    @include('chamado.reabertura')
  </div>
</div>    
@stop