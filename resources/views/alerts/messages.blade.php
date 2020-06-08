@if($errors->any())
  <div class="alert alert-warning">
   @foreach($errors->all() as $key => $error)
     <p>{{$error}}</p>
   @endforeach
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success">
  	{{session('success')}}
  </div>
@elseif(session('error'))
  <div class="alert alert-danger">
  	{{session('error')}}
  </div>
@elseif(session('info'))
  <div class="alert alert-warning">
    {{session('info')}}
  </div>  
@endif  

@if(session('error_grupoid'))
  <div class="alert alert-danger">
    {{session('error_grupoid')}}
  </div>
@endif  


