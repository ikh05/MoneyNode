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
        $user = Auth::user();
        $logs = $user->logs;
        // $log = ($user->is_admin) ? Log::all() : $user->logs;
        return view('dashboard')->with('user', $user)
            ->with('data', [
                'app' => [
                    [
                        'name' => 'Money Node', 
                        'path' => 'MoneyNode', 
                        'description' => 'Money Node adalah pencatat keuangan yang praktis dan efisien.',
                        'color' => 'primary',
                    ], [
                        'name' => 'Task Node', 
                        'path' => 'TaskNode', 
                        'description' => 'Task Node adalah daftar tugas yang harus diselesaikan.',
                        'color' => 'success',
                    ],
                ],
                'log' => $logs,
            ]);
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
