<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   Route::get('/', 'ChamadosController@index')
   ->name('chamado.index');
   
   Route::get('/create', 'ChamadosController@create')
   ->name('chamado.create'); 

   Route::post('/store', 'ChamadosController@store')
   ->name('chamado.store'); 
      
});