<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   Route::get('/', 'TipoUsuariosController@index')
   ->name('tipousuario.index');

   Route::post('/store', 'TipoUsuariosController@store')
   ->name('tipousuario.store');    

       

});