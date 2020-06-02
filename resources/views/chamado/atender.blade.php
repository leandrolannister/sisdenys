@extends('adminlte::page')

@section('title', 'Atendimento')

@section('content_header')
  <div class="box">
    <div class="box-header input-group">
      <form name="frmtecnico">
        @csrf
        <input type="hidden" name="movtoId"
               value="{{$chamado->id}}"> 
        <button type="submit"  
                class="btn btn-dark .text-white"
                name="btnMeuChamado">
                INICIAR ATENDIMENTO 
        </button>       
      </form> 
    </div>
  </div>         
@stop

  
@section('content')
<div class="box">    
  <div class="container">
    <div class="alert alert-success d-none messageBox" 
         role="alert"></div>     
    @include('alerts.messages')
    <form action="{{route('chamado.retornotecnico')}}" 
          method="post">          
          @csrf

      <input type="hidden" name="movtoId"
               value="{{$chamado->id}}">    

      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" 
               class="form-control"
               value="{{$chamado->titulo}}"
               disabled>
      </div>

      <div class="form-group mb-20">
        <label for="grupo">Grupo</label>
        <select name="grupochamado_id" 
                class="form-control">                
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

      <div class="box">
        <div class="box-header input-group">
          <span class="d-flex">
            <button type="submit" 
                    class="btn btn-info">
                    FINALIZAR
            </button>            
          </span>  
        </div>
      </div>    
    </form>  
  </div>
</div>    
@stop
<script src="{{asset('site/jquery.js')}}"></script> 
<script>
  $(function(){
  $('form[name="frmtecnico"]').submit(
    function(event){
    event.preventDefault();
    
    const movtoId = $('input[name="movtoId"]').val();

    $.ajax({
      url: "{{route('chamado.updatetecnico')}}",
      type: 'post',
      data: $(this).serialize(),
      dataType: 'json',
        success: function(resp){
          if(resp.success){
            $('.messageBox').removeClass('d-none').html(resp.message);
          }else{
            alert(resp.message);
          }

        },
        error: function(respError){
           console.log(respError);  
        } 
    });    
  });
});
</script>  