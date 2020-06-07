@extends('adminlte::page')

@section('title', 'Tipo Chamado')

@section('content_header')
  <h1>Cadastro->Tipo Chamado<h1>  
@stop

@section('content')
  <div class="box">    
    <div class="container"> 
      @include('alerts.messages')  
      <form action="{{route('tipochamado.store')}}" 
            method="post"
            class="mb-3">
        @csrf       
        <div class="form-group">
          <label for="name">Descrição</label>
          <input type="text" name="descricao" 
                 placeholder="Descrição do Tipo de Chamado" 
                 class="form-control">
        </div>
      <div>
        <button type="submit" class="btn btn-info">
          Cadastrar
        </button>
      </div>
    </form>
  </div>
@stop 

