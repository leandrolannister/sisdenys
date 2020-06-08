<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', function () {
    return view('home');    
})->middleware('auth')->name('home');

Route::get('/', function() {
    return view('auth.login');
});


Route::get('/email', function(){
   $user = new \stdClass();
   $user->name = 'Tully';
   $user->email = 'leandrohendrix@gmail.com';
   //return new App\Mail\Email($user);
   Mail::send(new App\Mail\Email($user));

});