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
          <th>Unidade</th>
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
                <option></option>
                @foreach($tipos as $t)
                {{$selected = $u->tipo == $t ? 'selected' : ''}} 
                  <option value="{{$t}}" <?=$selected?>>{{$t}}</option>
                  @endforeach  
                </select>
            </td>

            <td>
              <select name="unidade_id" 
                      class="form-control">
                <option></option>
                @foreach($unidadeList as $und)
                  {{$selected = $und->id == $u->tUndId 
                     ? 'selected' : ''}}
                  <option value="{{$und->id}}" <?=$selected?>>{{$und->nome}}</option>
                @endforeach  
              </select>
            </td>         
            
            <td>
              <button type="submit" 
                  class="btn btn-primary mr-2">
                  <i class="fa fa-plus" 
                     aria-hidden="true"></i>
                </button>
              </td>
            </form>
                       
            <form action="{{route('tipousuario.destroy')}}"
                  style="margin-left: -10px;" 
                  method="post"
                  onsubmit="return confirm('Tem certeza que deseja remover o relacionamento do usuário {{ addslashes($u->name)}}?')">
                 @csrf
                 @method('DELETE')

                 <input type="hidden" name="user_id" 
                     value="{{$u->id}}">

                 <input type="hidden" name="name" 
                      value="{{$u->name}}">

                @foreach($unidadeList as $und)
                  <input type="hidden" name="unidade_id"
                         value="{{$und->id}}">
                @endforeach
            
                <td>
                  <button type="submit" 
                          class="btn btn-danger mr-2"
                          style="margin-left: -80px" >
                       <i class="fa fa-trash" 
                          aria-hidden="true"></i>
                   </button>
                 </td>
              </form>
            </td>         
         </tr>
         @empty
           <p>sem Registro</p>
         @endforelse
      </tbody>
    </table>   
    {{$usersList->Links()}} 
  </div>
@stop 
