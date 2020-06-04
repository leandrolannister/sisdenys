<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   route::get('/', 'EquipamentosController@index')
   ->name('equipamento.index');

   route::get('/create', 'EquipamentosController@create')
   ->name('equipamento.create');

   route::post('/store', 'EquipamentosController@store')
   ->name('equipamento.store');

   route::get('/upgrade/{id}', 
   	'EquipamentosController@upgrade')
   ->name('equipamento.upgrade');

   route::put('/equipamento', 
   	'EquipamentosController@update')
   ->name('equipamento.update');
   
});