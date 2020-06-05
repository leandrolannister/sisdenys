@if($chamado->status == 'Fechado')
  <form action="{{route('chamado.reabrir')}}"
        method="post"
        enctype="multipart/form-data">
        @csrf    
    <input type="hidden" name="id" 
           value="{{$chamado->id}}">  

    <div>
      <input type="file" name="arquivo[]"
             class="form-control mb-2" 
             multiple>
    </div>          
            
    <label name="descricao">Descrição</label>
      <div class="input-group">
        <textarea class="form-control mb-2" 
        rows="5"
        name="descricao"
        aria-label="With textarea"
        placeholder="Descreva a ocorrência"></textarea>
      </div>         
      <button type="submit" 
              class="btn btn-danger ml-2">
              Reabrir
      </button>
  </form>
@endif