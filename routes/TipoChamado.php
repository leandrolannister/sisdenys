<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   route::get('/', 'TipoChamadosController@index')
   ->name('tipochamado.index');

   route::get('/create', 'TipoChamadosController@create')
   ->name('tipochamado.create'); 

   route::post('/store', 'TipoChamadosController@store')
   ->name('tipochamado.store'); 

   route::get('/upgrade/{id}', 
   	'TipoChamadosController@upgrade')
   ->name('tipochamado.upgrade');  

   route::put('/update', 'TipoChamadosController@update')
   ->name('tipochamado.update');    

});