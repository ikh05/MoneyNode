<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\MoneyNode\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MoneyNode\TransactionRecord;

class DashboardController extends Controller{
    public function index(){
        return view('dashboard')->with('user', Auth::user());
    }
    public function tes() {
        return view('tes', [
            'data' => [
                'log' => Log::all(),
                'user' => User::all(),
                'account' => Account::all(),
                'record' => TransactionRecord::all(),
            ],
        ]);
    }
}
