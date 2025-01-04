<?php



use App\Models\Log;
use App\Models\User;
use App\Models\MoneyNode\Account;
use App\Models\TransactionRecord;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MoneyNodeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Jika pengguna adalah admin

// Jika pengguna sudah login, arahkan ke dashboard

// Jika pengguna belum login, arahkan ke halaman sign in
Route::post('/sign', [SignController::class, 'sign'])->middleware('guest');
Route::get('/sign', [SignController::class, 'index'])->middleware('guest')->name('login');
Route::get('/sign/out', [SignController::class, 'logOut']);

// Book
Route::get('/mn', [MoneyNodeController::class, 'book'])->middleware('auth');
Route::get('/mn/account', [MoneyNodeController::class, 'account'])->middleware('auth');
Route::post('/mn/create/record', [MoneyNodeController::class, 'createRecord'])->middleware('auth');

// create
Route::get('/tes', function() {
return view('tes', [
        'data' => [
            'log' => Log::all(),
            'user' => User::all(),
            'account' => Account::all(),
            'record' => TransactionRecord::all(),
        ],
    ]);
});