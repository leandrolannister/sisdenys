<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;

class Movtochamado extends Model
{
   protected $fillable = ['titulo','tipo','status',
   'descricao','user_id', 'chamado_id', 
   'grupochamado_id','atendimento', 'tecnico'];

   public function chamado():object{
     return $this->belongsTo(Chamado::class);
   }

   public function grupoChamado():object {
     return $this->belongsTo(GrupoChamado::class);
   }

   public function setAttributeDescricao($desc):void{
    $this->attributes['descricao'] = 
    mb_strtoupper($desc);
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

   public function getUltimoMovto(int $chamado_id)
   :?object{

     $chamado = $this::where('id', 
     $chamado_id)->orderBy('created_at', 'desc')
     ->get()->first();

     return $chamado;
   }

   public function getUltimoChamado(int $chamado_id)
   :?object{

     $chamado = $this::where('chamado_id', 
     $chamado_id)->orderBy('created_at', 'desc')
     ->get()->first();

     return $chamado;
   }

   public function atendimentoChamado(int $grupochamado_id):object{
         
     $chamados = DB::table('movtoChamados as m')
     ->join('users as u', 'u.id', 'm.user_id')
     ->select('m.chamado_id', 'm.tipo',
      'm.status', 'm.descricao', 'm.created_at',
      'm.titulo', 'u.name', 'm.id', 'm.tecnico')
      ->where('m.status', TECNICO)
      ->Orwhere('m.status', REABERTO)
      ->where('m.grupochamado_id', $grupochamado_id)
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

   public function retornoTecnico(Request $req)
   :array{
     try{
     
       $movto = Movtochamado::where('id', 
       $req->movtoId)->orderby('id','desc')
       ->first();

       $movto->status = FECHADO;
       $movto->save();
              
       Movtochamado::create([
         "titulo" => $movto->titulo,
         "tipo" => $movto->tipo,
         "status" => FECHADO,
         "descricao" => $movto->descricao,
         "user_id" => $movto->user_id,
         "atendimento" => $req->atendimento,
         "tecnico" => auth()->user()->name,
         "chamado_id" => $movto->chamado_id,
         "grupochamado_id" => $movto->grupochamado_id
        ]);

      }catch(\Exception $e){ 
        dd($e->getMessage());       
        $chamado = ['id' => $movto->chamado_id,
                    'result' => false];

        return $chamado;
      }
      
      $chamado = ['id' => $movto->chamado_id,
                  'result' => true];

      return $chamado;
   }

   public function retornoTecnicoComArquivo(
   Request $req): array{

      try{
        $movto = Movtochamado::where('id', 
        $req->movtoId)->orderby('id','desc')
        ->first();

        $movto->status = FECHADO;
        $movto->save();
              
        Movtochamado::create([
           "titulo" => $movto->titulo,
           "tipo" => $movto->tipo,
           "status" => FECHADO,
           "descricao" => $movto->descricao,
           "user_id" => $movto->user_id,
           "atendimento" => $req->atendimento,
           "tecnico" => auth()->user()->name,
           "chamado_id" => $movto->chamado_id,
           "grupochamado_id" => $movto->grupochamado_id
        ]);

      }catch(\Exception $e){ 
        dd($e->getMessage());       
        
        return ['id' => $movto->chamado_id,
                'result' => false];        
      }
      
      //Xura
      $arquivo = (new Arquivo())
       ->store_a($req, $movto->chamado);

      if($movto and $arquivo):
         DB::commit();
         return ['id' => $movto->chamado_id,
                 'result' => true];
       endif;
       
       DB::rollback();
       
       return ['id' => $movto->chamado_id,
               'result' => false];  
   }

   public function historicoChamado(int $chamado_id)
   :object{
     
     $historico = 
     $this::where('chamado_id',$chamado_id)
     ->select('created_at', 'descricao', 
     'atendimento')->get();

     return $historico;
   }

   public function reabrirChamado(Movtochamado $movto)
   :bool{
      try{
        Movtochamado::create([
           "titulo" =>  $movto->titulo,
           "tipo" =>  $movto->tipo,
           "status" => REABERTO,
           "descricao" =>  $movto->descricao,
           "user_id" =>  $movto->user_id,
           "atendimento" => $movto->atendimento,
           "tecnico" =>  $movto->tecnico,
           "chamado_id" =>  $movto->chamado_id,
           "grupochamado_id" =>  $movto->grupochamado_id
        ]);
      }catch(Exception $e){
        return false;
      }  
      return true;

   }
}
