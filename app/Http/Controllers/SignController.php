<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SignController extends Controller{
    public function index(){
        return view('login');
    }

    public function sign(Request $request){
        switch ($request['sign']) {
            case 'up':
                return $this->register($request);
            case 'in':
                return $this->login($request);
            default:
                return $this->index();
        }
    }

    public function logOut(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/sign');
    }

    private function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3',
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        User::create($validatedData);

        return $this->login($request);
    }

    private function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back()->with('message', 'gagal login');
    }
}