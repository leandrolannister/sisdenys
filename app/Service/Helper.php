<?php 

namespace App\Service;
use Illuminate\Support\Carbon;

class Helper{

  public static function formatDate(String $data){
     return Carbon::parse($data)->format('d/m/Y');
  }
}
