@extends('adminlte::page')

@section('title', 'Tipo Usuários')

@section('content_header')
  <h1>Tipo Usuários<h1>  
@stop

@section('content')
  <div class="box-body">  
    @include('alerts.messages')
    <table class="table table-borderred 
                  table-hover table-striped">
      <thead>
        <tr>
          <th>Nome</th>  
          <th>Admin</th> 
          <th>Técnico</th> 
          <th>Comum</th>      
        </tr>  
      </thead>
      <tbody>
        @forelse($usersList as $u)
         <tr>
          <td>{{$u->name}}</td>
          <form action="{{route('tipousuario.store')}}"
                method="post">
          {{csrf_field()}}      
          <td>
            <input type="checkbox" value="Admin" 
                   name="Admin"
            <?=$tipousuario->seekType($u->id, 'Admin') 
             ? 'checked' : '' ?>>
          </td>
          <td>
            <input type="checkbox" value="Tecnico"
                    name="Tecnico"
            <?=$tipousuario->seekType($u->id, 'Tecnico') 
             ? 'checked' : '' ?>>
          </td>
          <td>
            <input type="checkbox" value="Comum"
                    name="Comum"
            <?=$tipousuario->seekType($u->id, 'Comum') 
             ? 'checked' : '' ?>>        
          </td>
          <td>
            <input type="hidden" value="{{$u->id}}"
                   name="user_id">
          </td>
          <td>
            <button type="submit" 
                    class="btn btn-primary">Salvar</button>
          </td>
        </form>
         </tr>
         @empty
           <p>sem Registro</p>
         @endforelse
      </tbody>
    </table>   
    {{$usersList->Links()}} 
  </div>
@stop 
