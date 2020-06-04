<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   route::get('/', 'GrupoChamadosController@index')
   ->name('grupochamado.index'); 

   route::get('/create', 'GrupoChamadosController@create')
   ->name('grupochamado.create'); 

   route::post('/store', 'GrupoChamadosController@store')
   ->name('grupochamado.store'); 

   route::get('/upgrade/{id}', 
   	'GrupoChamadosController@upgrade')
   ->name('grupochamado.upgrade');	

   route::put('/update', 
   	'GrupoChamadosController@update')
   ->name('grupochamado.update');	  
});