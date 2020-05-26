@extends('adminlte::page')

@section('title', 'Chamado')

@section('content_header')
  <h1>Novo Chamado</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('chamado.store')}}" 
          method="post">
      {!! csrf_field() !!}

      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" 
               placeholder="Titulo do chamado" 
               class="form-control"
               value="Novo Sistema">         
      </div>

      <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" class="form-control">
          <option value="Normal">Normal</option>
          <option value="Urgente">Urgente</option> 
        </select>          
      </div>

      <div class="form-group mb-20">
        <label for="grupo">Grupo</label>
        <select name="grupochamado_id" class="form-control">
          <option>Selecione um Grupo</option>
          @foreach($grupoList as $key => $g)            
            <option value="{{$g->id}}">
              {{$g->descricao}}
            </option>
          @endforeach  
        </select>                
      </div>  
      <label name="descricao">Descrição</label>
      <div class="input-group">
        <textarea class="form-control mb-2" rows="10" 
                  name="descricao"
                  aria-label="With textarea"
                  placeholder="Descreva a ocorrência">Favor elaborar um sistema de chamados</textarea>
      </div>      
      <div>
        <button type="submit" class="btn btn-info">
          Enviar
        </button>
      </div>
    </form>
  </div>    
@stop