@extends('adminlte::page')

@section('title', 'Instituição')

@section('content_header')
  <h1>Manutenção->Instituição</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('instituicao.update')}}" 
          method="post">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" 
             value="{{$instituicao->id}}">

      <div class="form-group">
        <label for="sigla">Sigla</label>
        <input type="text" name="sigla" 
               placeholder="Sigla da Instituição" 
               class="form-control"
               value="{{$instituicao->sigla}}">
      </div>

      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" 
               placeholder="Nome da Instituição" 
               class="form-control"
               value="{{$instituicao->nome}}">               
      </div>        

      <div>
        <button type="submit" class="btn btn-success">
          Atualizar
        </button>
      </div>
    </form>
  </div>    
@stop 
