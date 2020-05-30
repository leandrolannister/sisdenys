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

      <div class="form-group mb-20">
        <label for="grupo">Grupo</label>
        <select name="grupochamado_id" 
                class="form-control"
                <?=$statusAtual?>>
          <option>Selecione um Grupo</option>
          @foreach($grupoList as $g) 
            
            <?=$selected = 
            $chamado->grupochamado_id == $g->id
            ? 'selected' : ''; ?>           
           
           <option value="{{$g->id}}" <?=$selected?>>
              {{$g->descricao}}
            </option>
          @endforeach  
        </select>                
      </div>

      <label name="descricao">Descrição</label>
      <div class="input-group">
        <textarea class="form-control mb-2" rows="5"
                  name="descricao"
                  aria-label="With textarea"
                  placeholder="Descreva a ocorrência"
                  <?=$statusAtual?>
                  >{{$chamado->descricao}}</textarea>
      </div>  

      <button type="submit" <?=$statusAtual?> 
              class="btn btn-info">
        Atualizar
      </button>
    </form>  
  </div>
</div>    
@stop