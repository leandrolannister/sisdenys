<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   Route::get('/', 'ChamadosController@index')
   ->name('chamado.index');
   
   Route::get('/create', 'ChamadosController@create')
   ->name('chamado.create'); 

   Route::post('/store', 'ChamadosController@store')
   ->name('chamado.store'); 

   Route::post('/show', 'ChamadosController@show')
   ->name('chamado.show');

   Route::get('/atendimento', 
   	'ChamadosController@atendimento')
    ->name('chamado.atendimento');

   Route::post('/atender', 
   'ChamadosController@atender')
   ->name('chamado.atender'); 

   Route::post('/updatetecnico', 
   'ChamadosController@updateTecnico')
   ->name('chamado.updatetecnico');

      
});