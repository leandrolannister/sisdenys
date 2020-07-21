@if($historico->count() == 0)
  <label name="descricao">Descrição</label>
    <div class="input-group">
      <textarea class="form-control mb-2" rows="5"
                name="descricao"
                disabled 
                aria-label="With textarea"
                placeholder="Descreva a ocorrência">{{$chamado->descricao}}</textarea>
    </div>
@else
  <label style="margin-right: 530px">Usuário</label>
    <label>Técnico Responsável: 
      <span class="text-danger">{{mb_strtoupper($chamado->tecnico)}}</span>
    </label> 
  @foreach($historico as $h)
    <div class="input-group">
      <textarea rows="3" disabled 
        class="form-control mb-2 text-danger" 
        aria-label="With textarea">{{$h->descricao}}&#013;{{$h->created_at}}</textarea> 
            
        <textarea rows="3" disabled
          class="form-control mb-2 text-primary" 
          aria-label="With textarea">{{$h->atendimento}}&#013;{{$h->created_at}}
        </textarea>
    </div>
 @endforeach
@endif 