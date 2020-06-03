@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
  <h1>Atualização de Usuário</h1>  
@stop

@section('content')
  <div class="box">    
    <div class="container"> 
      @include('alerts.messages')  
      <form action="{{route('user.update')}}" method="post">
        {!! csrf_field() !!}        
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" name="name" 
                 placeholder="Nome do Usuário" 
                 class="form-control"  
                 value="{{$user->name}}">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" 
                 placeholder="Email do Usuário" 
                 class="form-control" value="{{$user->email}}">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" 
                 placeholder="Senha" 
                 class="form-control">
        </div> 
        @if($userType == 'Admin' || $userType == 'Tecnico')
        <div class="form-group mb-20">
          <label for="grupo">Grupo</label>
          <select name="grupochamado_id" 
                  class="form-control">
          <option>Selecione um Grupo</option>
            @foreach($grupoList as $g) 
              <option value="{{$g->id}}" 
              <?=$user->grupochamado_id == $g->id
               ? "selected" : "";?> >
              {{$g->descricao}}
            </option>
            @endforeach         
        </select>                
      </div>
      @endif  
        
      <div>
        <button type="submit" class="btn btn-info">Atualizar
        </button>
      </div>
    </form>
  </div>    
@stop 
