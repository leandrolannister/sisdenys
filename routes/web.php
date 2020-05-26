<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', function () {
    return view('home');    
})->middleware('auth');

Route::get('/', function() {
    return view('auth.login');
});
