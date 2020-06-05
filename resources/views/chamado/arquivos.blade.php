<div>
  @foreach($files as $key => $f)
    <a href='{{url("storage/{$f->path}")}}'
       target="_blank">
       Arquivo_{{++$key}}  
       {{date('d-m-Y', strtotime(substr($f->created_at, 0,10)))}}  
       {{substr($f->created_at, 11, 20)}}
       <br/>
    </a>
  @endforeach
</div>  