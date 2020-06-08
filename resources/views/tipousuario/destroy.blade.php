@extends('adminlte::page')

@section('title', 'Tipo Usuários')

@section('content_header')
  <h1>Tipo Usuários<h1>  
@stop

@section('content')
  <div class="box-body">  
    @include('alerts.messages')
    @include('tipousuario.filtro')
    <table class="table table-borderred 
                  table-hover table-striped">
      <thead>
        <tr>
          <th>Nome</th>  
          <th>Perfil</th> 
          <th>Instituição</th>
        </tr>  
      </thead>
      <tbody>
        @forelse($usersList as $u)
         <tr>
          <td>{{$u->name}}</td>
          <form action="{{route('tipousuario.destroy')}}"
                method="post">
          @csrf
          @method('DELETE')

          <input type="hidden" name="user_id" 
                 value="{{$u->id}}">

          <input type="hidden" name="name" value="{{$u->name}}">     

          <td>
            <select name="tipo" class="form-control">
              <option></option>
              @foreach($tipos as $t)
              {{$selected = $u->tipo == $t ? 'selected' : ''}} 
                <option value="{{$t}}" <?=$selected?>>{{$t}}</option>
              @endforeach  
            </select>
          </td>

          <td>
            <select name="instituicao_id" class="form-control">
              <option></option>
              @foreach($instituicaoList as $i)
              {{$selected = $i->id == $u->instituicao_id 
              ? 'selected' : ''}}
                <option value="{{$i->id}}" <?=$selected?>>{{$i->nome}}</option>
              @endforeach  
            </select>
          </td>         
          
          <td>
            <button type="submit" class="btn btn-danger mr-2">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
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
