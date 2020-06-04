@extends('adminlte::page')

@section('title', 'Manutenção Instituicao')

@section('content_header')
  <link rel="stylesheet" type="text/css" 
        href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@stop

@section('content')
  @include('alerts.messages')
  <table id="instituicaoTb" class="display">
    <thead>
      <tr>
        <td>Id</td>
        <th>Sigla</th>
        <th>Nome</th>
      </tr>
    </thead>
    <tbody>
      @forelse($instituicaoList as $i)
        <tr>
          <td>
            <a href="instituicao/upgrade/{{$i->id}}">{{$i->id}}</a>
          </td>
          <td>{{$i->sigla}}</td>
          <td>{{$i->nome}}</td>
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
      $('#instituicaoTb').DataTable();
   });
 </script>
@stop

