<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   Route::get('/create', 'UsersController@create')
   ->name('user.create');  

   Route::post('/usuario/update', 
   'UsersController@update')->name('user.update'); 

   Route::get('/', 'UsersController@index')
   ->name('user.index');

   Route::put('/edit', 'UsersController@edit')
   ->name('user.edit');
});