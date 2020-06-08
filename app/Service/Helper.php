<?php 

namespace App\Service;
use Illuminate\Support\Carbon;
use App\User;

class Helper{

  public static function formatDate(String $data):String{
     return Carbon::parse($data)->format('d/m/Y');
  }

  public static function checkStatus($status)
  :?String{

    switch ($status){
  	  case 'Pendente_Tecnico':
  	    return "disabled";	
  		break;

      case 'Fechado':
        return "disabled";  
      break;
  	  default:
  	    return null;	
  	}  	
  }

  public function getUnidadesAtendimento():array{
       $tipoUnidadesUser = [];
       
       foreach(auth()->user()->tipousuarios as $key => $u):
        array_push($tipoUnidadesUser, auth()->user()->tipousuarios[$key]->unidade_id);        
       endforeach;    

       return $tipoUnidadesUser;
    }
}
