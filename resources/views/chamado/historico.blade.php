<label style="margin-right: 530px">Causa</label>
<label>Solução</label>
@if($chamado->status != 'Reaberto') 
  @foreach($historico as $h)
    <div class="input-group">
      <textarea rows="3"
        class="form-control mb-2 text-danger" 
        aria-label="With textarea">{{$h->descricao}}&nbsp;{{$h->created_at}}</textarea> 

      <textarea rows="3"
        class="form-control mb-2 text-primary" 
        aria-label="With textarea">{{$h->atendimento}}&nbsp;{{$h->created_at}}
      </textarea>
    </div>
 @endforeach
@endif 