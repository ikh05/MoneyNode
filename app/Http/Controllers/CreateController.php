<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateController extends Controller{
    public function book(){
        // name, icon, 
        return view('new.book');
    }
}
