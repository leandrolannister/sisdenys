<?php 

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function(){
   
   Route::get('/create', 'UsersController@index')
   ->name('user.create');  

   Route::post('/usuario/update', 
   'UsersController@update')->name('user.update'); 
});