@extends('adminlte::page')

@section('title', 'Manutenção Tipo Chamado')

@section('content_header')
  <link rel="stylesheet" type="text/css" 
        href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@stop

@section('content')
  @include('alerts.messages')
  <table id="tipochamadoTb" 
         class="table table-borderred table-hover">
    <thead>
      <tr>
        <td>Id</td>
        <th>Descrição</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tipoList as $t)
        <tr>
          <td id="id">
            <a href="tipochamado/upgrade/{{$t->id}}">{{$t->id}}</a>
          </td>
          <td>{{$t->descricao}}</td>
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
      $('#tipochamadoTb').DataTable(
        
        );
   });
 </script>
@stop

