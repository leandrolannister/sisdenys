@extends('adminlte::page')

@section('title', 'Unidade')

@section('content_header')
  <h1>Manutenção->Unidade</h1>
@stop

@section('content')
<div class="box">
  <div class="container">
    @include('alerts.messages')
    <form action="{{route('unidade.update')}}"
          method="post">
      @csrf
      @method('PUT')

      <input type="hidden" name="id"
             value="{{$unidade->id}}">
      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome"
               placeholder="Nome do Unidade"
               class="form-control"
               value="{{$unidade->nome}}">

      </div>

      <div class="form-group">
        <label for="cep">Cep</label>
        <div class="input-group mb-3" style="width: 220px">
          <input type="text" name="cep"
                 placeholder="Cep da Instituição"
                 class="form-control"
                 value="{{$unidade->cep}}">

          <button type="submit"
                  class="btn btn-success"
                  name="btn-cep">Buscar
          </button>
        </div>
      </div>

      <div class="form-group">
        <label for="logradouro">Logradouro</label>
        <input type="text" name="logradouro"
               placeholder="Logradouro da Instituição"
               class="form-control"
               value="{{$unidade->logradouro}}">
      </div>

      <div class="form-group">
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro"
               placeholder="Bairro da Instituição"
               class="form-control"
               value="{{$unidade->bairro}}">
      </div>

      <div class="form-group">
        <label for="numero">Número</label>
        <input type="text" name="numero"
               placeholder="Número da Instituição"
               class="form-control"
               style="width: 220px"
               value="{{$unidade->numero}}">

      </div>

      <div class="form-group">
        <label for="complemento">Complemento</label>
        <input type="text" name="complemento"
               placeholder="Complemento da Instituição"
               class="form-control"
               value="{{$unidade->complemento}}">
      </div>
      <label name="instituicao_id">Instituição</label>
      <select name="instituicao_id"
              class="form-control mb-2">
        @foreach($instituicoes as $key => $i)
          <?=$selected = $i->id == $unidade->id
           ? "selected" : "";?>
          <option value="{{$i->id}}" <?=$selected?>>
            {{$i->nome}}
          </option>
        @endforeach
      </select>
      <div>
        <button type="submit" class="btn btn-success">
          Atualizar
        </button>
      </div>
    </form>
  </div>
@stop
<script src="{{asset('site/jquery.js')}}"></script>
<script type="text/javascript"
        src="{{asset('/js/apiViaCep.js')}}">
</script>
