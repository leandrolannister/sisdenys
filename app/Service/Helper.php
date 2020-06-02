<?php 

namespace App\Service;
use Illuminate\Support\Carbon;
use App\User;

class Helper{

  public static function formatDate(String $data){
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

  public function typeOfUser(String $grupo):bool{     
     
     if(!isset((auth()->user()->tipousuarios[0])))
       return true;

     $typeUser = 
     auth()->user()->tipousuarios[0]->descricao;

     $userGroup = (int) $grupo;
     if($typeUser == "Tecnico" and $userGroup == 0)
       return false;
       
     return true;   
  }   
}
