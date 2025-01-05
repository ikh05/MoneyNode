<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskNodeController extends Controller{

    public function index(){
        $user = Auth::user();
        return view('TaskNode.index', [
            'user' => $user,
        ]);
    }
}
