<?php

use App\Models\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\DashboardController;

// Jika pengguna adalah admin

// Jika pengguna sudah login, arahkan ke dashboard

// Jika pengguna belum login, arahkan ke halaman sign in
Route::post('/sign', [SignController::class, 'sign'])->middleware('guest');
Route::get('/sign', [SignController::class, 'index'])->middleware('guest')->name('login');
Route::get('/sign/out', [SignController::class, 'logOut']);

Route::get('/', [DashboardController::class, 'book'])->middleware('auth');
Route::get('/book/{book_id}', [DashboardController::class, 'book'])->middleware('auth');

// POST
Route::post('/create/record', [DashboardController::class, 'createRecord'])->middleware('auth');

// create
Route::get('/new/book', [CreateController::class, 'book'])->middleware('auth');
Route::get('/tes', function() {
    return view('tes', [
        'log' => Log::all(),
    ]);
})->middleware('auth');