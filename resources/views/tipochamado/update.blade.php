@extends('adminlte::page')

@section('title', 'Tipo de Chamado')

@section('content_header')
  <h1>Manutenção->Tipo de Chamados</h1>
@stop

@section('content')
<div class="box">
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('tipochamado.update')}}"
          method="post">
      @csrf
      @method('PUT')

      <input type="hidden" name="id"
             value="{{$tipo->id}}">

      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao"
               placeholder="Descrição do Tipo de Chamado"
               class="form-control"
               value="{{$tipo->descricao}}">

      </div>
      
      <div>
        <button type="submit" class="btn btn-success">
          Atualizar
        </button>
      </div>
    </form>
  </div>
@stop

