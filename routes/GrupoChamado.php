<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   Route::get('/', 'GrupoChamadosController@index')
   ->name('grupochamado.index'); 

   Route::get('/create', 'GrupoChamadosController@create')
   ->name('grupochamado.create');    
});