@extends('adminlte::page')

@section('title', 'Manutenção Grupo Chamados')

@section('content_header')
  <link rel="stylesheet" type="text/css" 
        href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@stop

@section('content')
  @include('alerts.messages')
  <table id="grupoTb" 
         class="table table-borderred table-hover">
    <thead>
      <tr>
        <td>Id</td>
        <th>Nome</th>
      </tr>
    </thead>
    <tbody>
      @forelse($grupoList as $g)  
        <tr>
          <td>
            <a href="grupochamado/upgrade/{{$g->id}}">
              {{$g->id}}
            </a>
          </td>
         <td>{{$g->descricao}}</td>
        </tr>
      @empty
        <p>sem Registro</p>
      @endforelse
    </tbody>
</table>
 <script src="{{asset('site/jquery.js')}}"></script>
 <script type="text/javascript" charset="utf8" 
        src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
 <script>
   $(document).ready(function () {
      $.noConflict();
      $('#grupoTb').DataTable();
   });
 </script>
@stop

