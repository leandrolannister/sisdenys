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
}
