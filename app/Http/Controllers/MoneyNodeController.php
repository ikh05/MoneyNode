<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\MoneyNode\Book;
use App\Models\MoneyNode\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MoneyNode\TransactionParty;
use App\Models\MoneyNode\TransactionRecord;
use App\Models\MoneyNode\TransactionCategory;

class MoneyNodeController extends Controller
{
    protected $data;
    public function __construct(){
        $user = Auth::user();
        $book_id = request('book');
        $load_book = ['icon'];

        // Jika tidak ada ID buku diberikan, ambil buku pertama milik user, sebaliknya ambil buku yang dengan ID yang diberikan
        if(!$book_id) $book = $user->books->load($load_book)->first();
        else $book = $user->books->where('id', $book_id)->load($load_book)->first(); // ambil buku dengan model user (memastikan buku milik user)
        
        // mengecek apakah ada buku yang diambil dari proses sebelumnya, jika tidak ada keluarkan error
        if (!$book) abort(403, 'Anda tidak memiliki akses ke buku ini');

        // simpan data user, bukum dan request('buku') kedalam data
        $this->data = [
            'auth' => $user,
            'book' => $book,
        ];
    }

    public function account(){
        $this->data = array_merge($this->data, [
            'title' => $this->data['book']->name,
            'account' => $this->data['book']->accounts->load('icon', 'records', 'transferToMe', 'transferFromMe')->groupBy('type'),
        ]);
        // dd($this->data);
        return view('money-node.Account', $this->data);
    }

    public function book() {
        $this->data = array_merge($this->data, [
            'title' => $this->data['book']->name,
            // upadete book
            'book' => $this->data['auth']->books->where('id', $this->data['book']->id)->load('parties.icon')->first(),

            // Modal Create Record
            'accounts' => $this->data['book']->accounts()->with('icon', 'records', 'transferFromMe', 'transferToMe')->get(),
            'categories' => $this->data['book']->categories()->with('icon')->get()->groupBy('type'),
            
            // Daftar Pengeluaran
            'records' => $this->data['book']->records->load(['category.icon', 'party', 'transferTo', 'transferFrom', 'transferTo.icon', 'account'])->groupBy('date')->sortBy('updated_at')->reverse(),
        ]);
        // dd($this->data);
        return view('money-node.dashboard', $this->data);
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
