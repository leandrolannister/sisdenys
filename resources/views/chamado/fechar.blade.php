@if(isset($chamado->id))
 <form action="{{route('chamado.fechar')}}"
       method="post"
       enctype="multipart/form-data"
       onsubmit="return confirm('Deseja fechar o chamado {{ addslashes($chamado->id) }}?')">
         @csrf    
   <input type="hidden" name="id" 
          value="{{$chamado->id}}">  
            
   <button type="submit" 
           class="btn btn-success ml-2">
            Fechar
     </button>    
 </form> 
@elseif($c->id)
  <form action="{{route('chamado.fechar')}}"
       method="post"
       enctype="multipart/form-data"
       onsubmit="return confirm('Deseja fechar o chamado {{ addslashes($c->id) }}?')">
         @csrf    
   <input type="hidden" name="id" 
          value="{{$c->id}}">  
            
   <button type="submit" class="btn btn-sm btn-danger"
          style="margin-left: -50px">
     <i class="fa fa-trash" aria-hidden="true"></i>
   </button>    
 </form> 
@endif 
