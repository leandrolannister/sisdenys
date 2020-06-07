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
          <th>Perfil</th> 
        </tr>  
      </thead>
      <tbody>
        @forelse($usersList as $u)
         <tr>
          <td>{{$u->name}}</td>
          <form action="{{route('tipousuario.store')}}"
                method="post">
          @csrf

          <input type="hidden" name="user_id" 
                 value="{{$u->id}}">
          <td>
            <select name="tipo" class="form-control">
              @foreach($tipoList as $t) 
              {{$selected = $t == $u->tipo ? 'selected':''}} 
                <option value="{{$t}}" <?=$selected?>>{{$t}}</option>
              @endforeach
            </select>
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
