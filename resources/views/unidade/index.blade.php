@extends('adminlte::page')

@section('title', 'Manutenção Instituicao')

@section('content_header')
  <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@stop

@section('content')
  @include('alerts.messages')
  <table id="UnidadeTb"
         class="table table-borderred table-hover">
    <thead>
      <tr>
        <td>Id</td>
        <th>Nome</th>
        <th>Cep</th>
        <th>Logradouro</th>
        <th>Bairro</th>
        <th>Número</th>
        <th>Instituição</th>
      </tr>
    </thead>
    <tbody>
      @forelse($unidadeList as $e)
        <tr>
          <td>
            <a href="unidade/upgrade/{{$e->id}}">
              {{$e->id}}
            </a>
          </td>
         <td>{{$e->nome}}</td>
         <td>{{$e->cep}}</td>
         <td>{{$e->logradouro}}</td>
         <td>{{$e->bairro}}</td>
         <td>{{$e->numero}}</td>
         <td>{{$e->instituicao->nome}}</td>
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
      $('#UnidadeTb').DataTable();
   });
 </script>
@stop

