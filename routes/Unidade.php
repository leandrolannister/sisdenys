<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){

   route::get('/', 'UnidadesController@index')
   ->name('unidade.index');

   route::get('/create', 'UnidadesController@create')
   ->name('unidade.create');

   route::post('/store', 'UnidadesController@store')
   ->name('unidade.store');

   route::get('/upgrade/{id}',
   	'UnidadesController@upgrade')
   ->name('unidade.upgrade');

   route::put('/Unidade',
   	'UnidadesController@update')
   ->name('unidade.update');

});
