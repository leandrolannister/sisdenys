<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   route::get('/', 'InstituicoesController@index')
   ->name('instituicao.index');

   route::get('/create', 'InstituicoesController@create')
   ->name('instituicao.create');

   route::post('/store', 'InstituicoesController@store')
   ->name('instituicao.store');

   route::get('/upgrade/{id}', 
   	'InstituicoesController@upgrade')
   ->name('instituicao.upgrade');

   route::put('/update', 
   	'InstituicoesController@update')
    ->name('instituicao.update');
});