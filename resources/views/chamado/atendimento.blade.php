@extends('adminlte::page')

@section('title', 'Atendimento Chamado')

@section('content_header')
  <h1>Atendimento Chamado<h1>  
@stop

@section('content')
   @include('chamado.filtros')
  <div class="box-body">  
    @include('alerts.messages') 
    <table class="table table-borderred table-hover table-striped">
      <thead>
        <tr>
          <th>Número</th>
          <th>Titulo</th>
          <th>Status</th>
          <th>Data</th> 
          <th>Usuário</th> 
          <th>Técnico</th>        
        </tr>  
      </thead>
      <tbody>
        @foreach($chamados as $key => $c)
           <tr>
            <td>{{$c->chamado_id}}</td>
             <td>{{$c->titulo}}</td>
             <td>{{$c->status}}</td>
             <td>
              {{$helper::formatDate($c->created_at)}}
            </td>
            <td>{{$c->name}}</td>
            <td>{{$c->tecnico}}</td>
            <td>
              <form action="{{route('chamado.atender', $c->id)}}">
               
                <button type="submit" 
                        class="btn btn-info btn-sm">
                    <i class="fas fa-search"></i> 
                </button>       
              </form>
            </td>
            <td>
              @if($c->status == 'Pendente_usuario')
                @include('chamado.fechar')
              @endif
            </td>  
           </tr>
         @endforeach  
      </tbody>
    </table> 
    @if(isset($chamadosPaginate))
      {{$chamados->appends($chamadosPaginate)}}
    @else  
      {{$chamados->links()}}  
    @endif  
  </div>
@stop 
