<div class="box">
  <div class="box-header">
    <form action="{{route('tipousuario.filtro')}}" 
          method="post"class="form form-inline mb-2">
      @csrf
      <input type="text" name="name" class="form-control" 
             placeholder="Nome do usuário"
             style="margin-right: 5px;">            
       
       <button type="submit" class="btn btn-primary">
        Pesquisar
      </button>
    </form>      
  </div>
</div>