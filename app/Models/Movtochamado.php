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

   public function getUltimoChamado(int $chamado_id)
   :object{

     $chamado = $this::where('chamado_id', 
     $chamado_id)->orderBy('id', 'desc')
     ->get()->last();

     return $chamado;
   }

   public function atendimentoChamado(int $grupochamado_id):object{
     
     $chamados = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id', 'm.tipo',
      'm.status', 'm.descricao', 'm.created_at',
      'm.titulo', 'u.name', 'm.id', 'm.tecnico')
      ->where('m.status', TECNICO)
      ->get();

     return $chamados;
   }

   public function atenderChamado(int $movto_id)
   :object{

     $chamado = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id', 'm.tipo',
      'm.status', 'm.descricao', 'm.created_at',
      'm.titulo', 'm.id', 'm.grupochamado_id', 
      'u.email')
      ->where('m.id', $movto_id)
      ->get();

      return $chamado;      
   }  

   public function updateTecnico(array $dados)
   :bool{
     
     try{
       $movto = $this::find($dados['movtoId']);
       $movto->tecnico = auth()->user()->name;
       $movto->save(); 
     }catch(\Exception $e){
      return false;
     }  
     return true;
   }
}
