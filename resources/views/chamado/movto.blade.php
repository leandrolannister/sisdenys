@extends('adminlte::page')

@section('title', 'Histórico Chamados')

@section('content_header')
  <h1>Histórico de Chamados<h1>  
@stop

@section('content')
  <div class="box-body">  
    <div>
      <a href="#">
      Novo Chamado</a>
    </div> 
    @include('alerts.messages') 
    @include('chamado.filtroMeusChamados')
    <table class="table table-borderred table-hover table-striped">
      <thead>
        <tr>
          <th>Número</th>
          <th>Titulo</th>
          <th>Status</th>
          <th>Data Movto</th>          
        </tr>  
      </thead>
      <tbody>
         @foreach($chamados as $key => $c)
           <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->titulo}}</td>
            <td>{{$c->status}}</td>
            @if(isset($c->data))
              <td>{{$helper::formatDate($c->data)}}</td>
            @else
              <td>{{$helper::formatDate($c->created_at)}}</td>  
            @endif  
          </td> 
           </tr>
         @endforeach  
      </tbody>
    </table>   
  </div>
@stop 
