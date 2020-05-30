@extends('adminlte::page')

@section('title', 'Atendimento')

@section('content_header')
  <h1>Atendimento Chamado</h1>  
@stop

@section('content')
<div class="box">    
  <div class="container">
    @include('alerts.messages')
    <form action="#" 
          method="post"
          enctype="multipart/form-data">
          @csrf

      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" 
               class="form-control"
               value="{{$chamado->titulo}}"
               disabled>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" 
               class="form-control"
               value="{{$chamado->email}}"
               disabled>
      </div>

      <label name="descricao">Descrição</label>
      <div class="input-group">
        <textarea class="form-control mb-2" rows="5"
                 name="descricao"
                 disabled 
                 aria-label="With textarea"
                 placeholder="Descreva a ocorrência"
                 >{{$chamado->descricao}}</textarea>
      </div>

      <div>
        @foreach($files as $key => $f)
          <a href='{{url("storage/{$f->path}")}}'
          target="_blank">
          Arquivo_{{++$key}}<br/>
        </a>
        @endforeach
      </div>      

      <label name="atendimento">Atendimento</label>
      <div class="input-group">
        <textarea class="form-control mb-2" rows="5"
                 name="atendimento"
                 aria-label="With textarea"
                 placeholder="Descreva o parecer técnico"></textarea>
      </div>  

      <button type="submit" 
              class="btn btn-info">
        Atualizar
      </button>
    </form>  
  </div>
</div>    
@stop