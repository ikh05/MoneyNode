<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\CheckClassRoom;

use App\Http\Controllers\SignController;
use App\Http\Controllers\TaskNodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MoneyNodeController;

// Jika pengguna belum login, arahkan ke halaman sign in
Route::middleware('guest')->group(function(){
    Route::post('/sign', [SignController::class, 'sign']);
    Route::get('/sign', [SignController::class, 'index'])->name('login');
});

Route::middleware('auth')->group(function(){
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    
    // tes, hanya bisa digunakan saat dev
    Route::get('/tes', [DashboardController::class, 'tes'])->middleware(SuperAdmin::class);
    
    // log out
    Route::get('/sign/out', [SignController::class, 'logOut']);

    // TaskNode
    Route::prefix('TaskNode')->group(function(){
        Route::get('/', [TaskNodeController::class, 'index'])->middleware(CheckClassRoom::class)->name('TaskNode');
        Route::get('/create/classroom', [TaskNodeController::class, 'createClassRoom'])->name('create_ClassRoom');
        Route::post('/create/classroom', [TaskNodeController::class, 'logic_createClassRoom']);
        Route::get('/exit/classroom/{id}', [TaskNodeController::class, 'logic_exitClassRoom']);
        Route::get('/create/task', function(){return view('tes', ['data' => request()]);});
        Route::post('/create/task', [TaskNodeController::class, 'logic_createTask']);
        Route::post('/update/task', [TaskNodeController::class, 'logic_updateTask'])->name('tn_update-record');
        Route::delete('/delete/task/{id}', [TaskNodeController::class, 'logic_delete'])->name('assignment.delete');
    });
    
    // MoneyNode
    Route::prefix('MoneyNode')->group(function(){
        Route::get('/', [MoneyNodeController::class, 'book']);
        Route::get('/account', [MoneyNodeController::class, 'account']);
        Route::post('/create/record', [MoneyNodeController::class, 'createRecord']);
    });
});