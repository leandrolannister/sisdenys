@extends('adminlte::page')

@section('title', 'Grupo de Chamados')

@section('content_header')
  <h1>Cadastro->Grupo de Chamados</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('grupochamado.store')}}" 
          method="post">
      {!! csrf_field() !!}
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" 
               placeholder="Descrição do Grupo" 
               class="form-control">         
      </div>

      <div> 
        <button type="submit" class="btn btn-success">
          Gravar
        </button>
      </div>        
    </form>
  </div>    
@stop