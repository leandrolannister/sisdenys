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

   route::get('/atender/{chamadoId}', 
   'ChamadosController@atender')
   ->name('chamado.atender'); 

   route::post('/updatetecnico', 
   'ChamadosController@updateTecnico')
   ->name('chamado.updatetecnico');

   route::any('/retornotecnico',
   'ChamadosController@retornotecnico')
   ->name('chamado.retornotecnico');

   route::post('/rejeitado', 
   'ChamadosController@reabrirchamado')
   ->name('chamado.reabrir');

   route::any('/filtro', 'ChamadosController@filtro')
   ->name('chamado.filtro');

   route::any('/filtroMeusChamados', 
      'ChamadosController@filtrarMeusChamados')
   ->name('chamado.filtroMeusChamados');

   route::get('/movto', 
   'ChamadosController@movtochamado')
   ->name('chamado.movto');

   route::post('/fecharChamado', 'ChamadosController@fechar')
   ->name('chamado.fechar');     
});