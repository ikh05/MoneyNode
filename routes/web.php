<?php

use App\Http\Controllers\SignController;
use Illuminate\Support\Facades\Route;

// Jika pengguna adalah admin

// Jika pengguna sudah login, arahkan ke dashboard

// Jika pengguna belum login, arahkan ke halaman sign in
Route::post('/sign', [SignController::class, 'sign'])->middleware('guest');
Route::get('/sign', [SignController::class, 'index'])->middleware('guest')->name('login');

Route::get('/', function () { return view('dashboard'); })->middleware('auth');
Route::get('/sign/out', [SignController::class, 'logOut']);