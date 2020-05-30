<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Movtochamado extends Model
{
   protected $fillable = ['titulo','tipo','status',
   'descricao','user_id', 'chamado_id', 
   'grupochamado_id'];

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   }

   public function grupoChamado():object {
     return $this->belongsTo(GrupoChamado::class);
   }
   
   public function store_mc(Chamado $chamado, 
   	                        array $dados): bool{
     try{
   	   $chamado->movtoChamados()
   	   ->create($dados);

   	 }catch(\Exception $e){
   	   return false;
   	 }
   	 return true;
   } 

   public function atendimentoChamado(int $grupochamado_id):object{
     
     /*$chamados = $this::where('grupochamado_id',
     $grupochamado_id)->where('status', TECNICO)
     ->get();*/

     $chamados = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id as id', 'm.tipo',
      'm.status', 'm.descricao', 'm.created_at',
      'm.titulo', 'u.name')->get();

     return $chamados;
   }  
}
