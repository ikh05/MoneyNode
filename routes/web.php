<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MoneyNodeController;


// Jika pengguna belum login, arahkan ke halaman sign in
Route::post('/sign', [SignController::class, 'sign'])->middleware('guest');
Route::get('/sign', [SignController::class, 'index'])->middleware('guest')->name('login');
Route::get('/sign/out', [SignController::class, 'logOut']);

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/tes', [DashboardController::class, 'tes']);

// Book
Route::get('/mn', [MoneyNodeController::class, 'book'])->middleware('auth');
Route::get('/mn/account', [MoneyNodeController::class, 'account'])->middleware('auth');
Route::post('/mn/create/record', [MoneyNodeController::class, 'createRecord'])->middleware('auth');
