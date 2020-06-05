<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Arquivo extends Model
{
    protected $fillable = ['path', 'chamado_id'];

    public function chamados():object{
    	return $this->belongsTo(Chamado::class);
    }

    public function store_a(Request $req, 
    	                    Chamado $chamado): bool{ 
      try{ 
        foreach($req->arquivo as $key => $a):       
          $file = $req->allFiles()['arquivo'][$key];
        
          $chamado->arquivos()->create([
            'chamado_id' => $chamado->id,
            'path' => $file
            ->store("chamados/$chamado->id")]);	
          unset($chamado->arquivo);
        endforeach;  
     }catch(\Exception $e){
     	return false;
     }   
     return true;
    }

    public function list(int $chamado_id):object{
      $arquivos = 
      $this::where('chamado_id', $chamado_id)
      ->select('path','created_at')
      ->orderby('created_at')
      ->get();
      
      return $arquivos;
    }
}
