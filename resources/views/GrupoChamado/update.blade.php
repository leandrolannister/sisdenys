@extends('adminlte::page')

@section('title', 'Grupo de Chamado')

@section('content_header')
  <h1>Manutenção->Grupo de Chamado</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('grupochamado.update')}}" 
          method="post">
      @csrf
      @method('put')
      <input type="hidden" name="id"
             value="{{$grupochamado->id}}">

      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" 
               placeholder="Descrição do Grupo" 
               class="form-control"
               value="{{$grupochamado->descricao}}">
      </div>

      <div> 
        <button type="submit" class="btn btn-success">
          Atualizar
        </button>
      </div>        
    </form>
  </div>    
@stop