<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\checkReqAjax;
use App\Http\Middleware\CheckClassRoom;

use App\Http\Controllers\SignController;
use App\Http\Controllers\TaskNodeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IcABotTelegramController;
use App\Http\Controllers\MoneyNodeController;

// Jika pengguna belum login, arahkan ke halaman sign in
Route::middleware('guest')->group(function(){
    Route::post('/sign', [SignController::class, 'sign']);
    Route::get('/sign', [SignController::class, 'index'])->name('login');
});

Route::middleware('auth')->group(function(){
    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    
    // tes, hanya bisa digunakan saat dev
    Route::get('/tes', [DashboardController::class, 'tes'])->middleware(SuperAdmin::class);
    
    // log out
    Route::get('/sign/out', [SignController::class, 'logOut']);

    // TaskNode
    Route::prefix('TaskNode')->group(function(){
        Route::get('/', [TaskNodeController::class, 'index'])->middleware(CheckClassRoom::class)->name('TaskNode');
        Route::get('/create/classroom', [TaskNodeController::class, 'createClassRoom'])->name('create_ClassRoom');
        Route::post('/create/classroom', [TaskNodeController::class, 'logic_createClassRoom']);
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
    // Route::get('/update/task', [TaskNodeController::class, 'logic_updateTask']);
});

Route::get('bot/telegram/', [IcABotTelegramController::class, 'index']);

Route::get('tes_dns',function(){
    function tes($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout 10 detik
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
    
        if ($response) {
            echo "Koneksi ke ".$url." berhasil: " . htmlspecialchars($response);
        } else {
            echo "Koneksi ".$url." gagal: " . htmlspecialchars($error);
        }
    };
    tes("https://api.telegram.org");
    tes("api.scraperapi.com");

});


