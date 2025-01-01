<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Book;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\TransactionParty;
use App\Models\TransactionRecord;
use App\Models\TransactionCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpParser\ErrorHandler\Collecting;

class DashboardController extends Controller{
    protected $data = [];
    protected function getBook(Request $request){
        $user = Auth::user();
        // Jika tidak ada ID buku diberikan, ambil buku pertama milik user
        if (!isset($request['book'])) $book = $user->books->first(); // Andaikan ada relasi 'books' di model User
        else $book = $user->books->where('id', $request['book'])->first(); // Cari buku berdasarkan ID, pastikan buku tersebut milik pengguna
        if (!$book) abort(403, 'Anda tidak memiliki akses ke buku ini');
        else if(isset($request['book'])) $this->data = ['req_book' => $book->id];
        return $book;
    }

    public function account(Request $request){
        $user = Auth::user();
        $book = $this->getBook($request);
        $this->data = array_merge($this->data, [
            'title' => $book->name,
            'auth' => $user,
            'book' => $book,
        ]);
        return view('Account', $this->data);
    }

    public function book(Request $request) {
        $user = Auth::user(); // Dapatkan pengguna yang sedang login
        $book = $this->getBook($request);
        $this->data = array_merge($this->data, [
            'title' => $book->name,
            'auth' => $user,
            'book' => $book,
            'categories' => [
                'income' =>  $book->categories()->filterByType(['type'=>'income'])->get(),
                'expense' => $book->categories()->filterByType(['type'=>'expense'])->get(),
            ],
            'records' => $book->records->groupBy('date')->sortDesc()->map(function($f){return $f->sortByDesc('updated_at');})->reverse(),
        ]);
        return view('dashboard', $this->data);
    }









    // Create Record
    public function createRecord(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'book_id' => 'required',
            'type' => 'required',
            'nominal' => 'required',
            'date' => 'required',
            'description' => 'nullable',
            // type [income, expense]
            'account_id' => 'required',
            'party_id' => 'required',
            'category_id' => 'required',
            // type [transfer]
            'to_account_id' => 'required',
        ]);
        
        // apakah book merupakan buku user
        $book = Book::where('id', $validatedData['book_id'])->first();
        if(Auth::user()->id !== $book->user_id){
            return back()->with('error', 'Buku tidak ditemukan');
        }
        // dd($validatedData);
        // type dan account
        if($book->id !== Account::where('id', $validatedData['account_id'])->first()->book_id) return back()->with('error', 'Gagal menambahkan (error '.__LINE__.')');
        switch ($validatedData['type']) {
            case 'income':
            case 'expense':
                if($book->id !== TransactionCategory::where('id', $validatedData['category_id'])->first()->book_id) return back()->with('error', 'Gagal menambahkan (error '.__LINE__.')');
                if($book->id !== TransactionParty::where('id', $validatedData['party_id'])->first()->book_id) return back()->with('error', 'Gagal menambahkan (error '.__LINE__.')');
                unset($validatedData['to_account_id']);
                break;
            case 'transfer':
                $validatedData['from_account_id'] = $validatedData['account_id'];
                unset($validatedData['category_id']);
                unset($validatedData['account_id']);
                unset($validatedData['party_id']);
                if($book->id !== Account::where('id', $validatedData['to_account_id'])->first()->book_id) return back()->with('error', 'Gagal menambahkan (error '.__LINE__.')');
                break;            
            default:
                return back()->with('error', 'Gagal menambahkan (error '.__LINE__.')');
                break;
        }
        $data = TransactionRecord::create($validatedData);
        Log::createRecord($data);
        $request->session()->regenerate();
        return back();
    }
}
