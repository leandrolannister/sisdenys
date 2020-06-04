<div>
  @foreach($files as $key => $f)
    <a href='{{url("storage/{$f->path}")}}'
       target="_blank">
       Arquivo_{{++$key}}<br/>
    </a>
  @endforeach
</div>  