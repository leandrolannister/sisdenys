@extends('adminlte::page')

@section('title', 'Meus Chamados')

@section('content_header')
  <h1>Meus Chamados<h1>  
@stop

@section('content')
  <div class="box-body">  
    <div>
      <a href="{{route('chamado.create')}}">
      Novo Chamado</a>
    </div> 
    @include('alerts.messages') 
    <table class="table table-borderred table-hover table-striped">
      <thead>
        <tr>
          <th>Número</th>
          <th>Titulo</th>
          <th>Status</th>
          <th>Data</th>          
        </tr>  
      </thead>
      <tbody>
         @foreach($chamados as $key => $c)
           <tr>
            <td>{{$c->id}}</td>
             <td>{{$c->Titulo}}</td>
             <td>{{$c->Status}}</td>
             <td>
              {{$helper::formatDate($c->Data)}}
            </td>
            <td>
            <form action="{{route('chamado.show')}}"
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
