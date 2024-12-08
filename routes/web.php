<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tes', function(){
    return view("a");
});
Route::get('/a', function(){
    return view('aaaa');
});