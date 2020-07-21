<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   route::get('/', 'TipoUsuariosController@index')
   ->name('tipousuario.index');

   route::post('/store', 'TipoUsuariosController@store')
   ->name('tipousuario.store');

   route::delete('/delete', 'TipoUsuariosController@destroy')
   ->name('tipousuario.destroy'); 

   route::post('/filtro', 'TipoUsuariosController@filtro')
   ->name('tipousuario.filtro');       

});