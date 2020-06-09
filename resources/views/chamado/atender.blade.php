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
          method="post"
          enctype="multipart/form-data">          
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
      
      <div>
        <label name="tipochamado_id">Tipo</label>
        <select name="tipochamado_id"
                class="form-control mb-1">Tipo
          @foreach($tipoList as $t)
          {{$selected = $chamado->tipochamado_id == 
            $t->id ? 'selected' : ''}}
            <option value="{{$t->id}}" <?=$selected?>>
              {{$t->descricao}}
            </option>
          @endforeach
        </select>  
      </div>
      
      @include('chamado.historico')  
      @include('chamado.arquivos') 

      <div>
        <input type="file" name="arquivo[]"
               class="form-control mb-2" 
               multiple>
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