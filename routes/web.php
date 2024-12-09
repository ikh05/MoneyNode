<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/', function(){
    return view("login");
})->middleware('guest');