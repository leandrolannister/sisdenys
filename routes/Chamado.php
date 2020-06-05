<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   route::get('/', 'ChamadosController@index')
   ->name('chamado.index');
   
   route::get('/create', 'ChamadosController@create')
   ->name('chamado.create'); 

   route::post('/store', 'ChamadosController@store')
   ->name('chamado.store'); 

   route::post('/show', 'ChamadosController@show')
   ->name('chamado.show');

   Route::get('/atendimento', 
   	'ChamadosController@atendimento')
    ->name('chamado.atendimento');

   route::post('/atender', 
   'ChamadosController@atender')
   ->name('chamado.atender'); 

   route::post('/updatetecnico', 
   'ChamadosController@updateTecnico')
   ->name('chamado.updatetecnico');

   route::post('/retornotecnico',
   'ChamadosController@retornotecnico')
   ->name('chamado.retornotecnico');

   route::post('/rejeitado', 
   'ChamadosController@reabrirchamado')
   ->name('chamado.reabrir');

   route::post('/filtro', 'ChamadosController@filtro')
   ->name('chamado.filtro');


      
});