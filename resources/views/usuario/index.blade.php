@extends('adminlte::page')

@section('title', 'Usuário Perfil')

@section('content_header')
  <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
@stop

@section('content')
  @include('alerts.messages')
  <table id="userTb"
         class="table table-borderred table-hover">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Perfil</th>
        <th>Atualizar</th>
      </tr>
    </thead>
    <tbody>
      @forelse($userList as $u)
        <tr> 
         <form action="{{route('user.edit')}}"
               method="post">
           @csrf
           @method('put')  
           <input type="hidden" name="id"  
                  value="{{$u->id}}">              
           <td>{{$u->name}}</td>
           <td>{{$u->email}}</td>
           <td>
             <select name="perfil" class="form-control">
               @foreach($perfis as $p) 
                 {{$selected = $p == $u->perfil 
                 ? 'selected' : ''}}
                 <option value="{{$p}}"<?=$selected?>>{{$p}}</option>
               @endforeach 
             </select>
           </td>
           <td>
             <button type="submit" 
                     class="btn btn-success btn-sm">
                <i class="fa fa-wrench"></i> 
             </button>
           </td>
         </form>
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
      $('#userTb').DataTable();
   });
 </script>
@stop