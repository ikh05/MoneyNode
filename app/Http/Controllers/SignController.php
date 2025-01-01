<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\TransactionParty;
use App\Http\Controllers\Controller;
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
            'username' => 'required|unique:users|max:255',
            'password' => 'required',
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        $book = Book::default_($user);
        Account::default_($book);
        TransactionParty::default_($book);
        return $this->login($request);
    }

    private function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back()->with('message', 'gagal login');
    }
}