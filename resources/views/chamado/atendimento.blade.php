@extends('adminlte::page')

@section('title', 'Atendimento Chamado')

@section('content_header')
  <h1>Atendimento Chamado<h1>  
@stop

@section('content')
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
        </tr>  
      </thead>
      <tbody>
         @foreach($chamados as $key => $c)
           <tr>
            <td>{{$c->id}}</td>
             <td>{{$c->titulo}}</td>
             <td>{{$c->status}}</td>
             <td>
              {{$helper::formatDate($c->created_at)}}
            </td>
            <td>{{$c->name}}</td>
            <td>
            <form action="#"
                  method="post">
              {{csrf_field()}}
              <input type="hidden" name="chamado_id"
                     value="{{$c->id}}">
              <button type="submit" 
                      class="btn btn-info btn-sm">
                <i class="fas fa-search"></i> 
              </button>       
            </form>
          </td> 
           </tr>
         @endforeach  
      </tbody>
    </table>   
  </div>
@stop 
