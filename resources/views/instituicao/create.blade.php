@extends('adminlte::page')

@section('title', 'Instituição')

@section('content_header')
  <h1>Cadastro->Instituição</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('instituicao.store')}}" 
          method="post">
      {!! csrf_field() !!}

      <div class="form-group">
        <label for="sigla">Sigla</label>
        <input type="text" name="sigla" 
               placeholder="Sigla da Instituição" 
               class="form-control">               
      </div>

      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" 
               placeholder="Nome da Instituição" 
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
