<?php

namespace App\Models\MoneyNode;

use App\Models\Icon;
use App\Models\User;
use App\Models\MoneyNode\Account;
use App\Models\MoneyNode\TransactionParty;
use App\Models\MoneyNode\TransactionRecord;
use App\Models\MoneyNode\TransactionCategory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNumeric;

class Book extends Model
{
    protected $guarded = ['id'];

    // Tentukan nama tabel dengan prefix "mn"
    protected $table = 'mn_books';
    
    protected static function booted(){

        static::creating(function ($book){
            if($book->icon_id === null) $book->icon_id = 1;
        });
        static::created(function ($book) {
            // 2. Membuat Account Default untuk User
            $book->accounts()->create(['name' => 'Cash','first_nominal' => 0,'currency' => 'IDR','icon_id' => 13,'type'=>'cash',]);
            $book->accounts()->create(['name' => 'Uang Darurat','first_nominal' => 0,'currency' => 'IDR','icon_id' => 13,'type'=>'cash',]);
            $book->accounts()->create(['name' => 'Tabungan','first_nominal' => 0,'currency' => 'IDR','icon_id' => 14,'type'=>'virtual',]);
            $book->accounts()->create(['name' => 'Hutang','first_nominal' => 0,'currency' => 'IDR','icon_id' => 15,'type'=>'hutang', 'description' => 'Jika dirimu berhutang, lakukan transfer dari account ini ke account lain!, begitu juga sebaliknya jika kamu bayar hutang!']);
            $book->accounts()->create(['name' => 'Piutang','first_nominal' => 0,'currency' => 'IDR','icon_id' => 15,'type'=>'piutang', 'description' => 'Jika orang berhutang kepada mu, lakukan transfer dari account lain ke account ini!, begitu juga sebaliknya jika orang tersebut bayar hutang!']);

            // 3. Membuat Category Default untuk Book (Pengeluaran dan Pemasukan)
            // Kategori Pengeluaran (Expense)
            $book->categories()->create(['name' => 'Food','type' => 'expense','icon_id' => 2,]);
            $book->categories()->create(['name' => 'Transportation','type' => 'expense','icon_id' => 3,]);
            $book->categories()->create(['name' => 'Utilities','type' => 'expense','icon_id' => 4,]);
            $book->categories()->create(['name' => 'Entertainment','type' => 'expense','icon_id' => 5,]);
            $book->categories()->create(['name' => 'Health','type' => 'expense','icon_id' => 6,]);

            // Kategori Pemasukan (Income)
            $book->categories()->create(['name' => 'Salary','type' => 'income','icon_id' => 7,]);
            $book->categories()->create(['name' => 'Investment','type' => 'income','icon_id' => 8,]);
            $book->categories()->create(['name' => 'Gift','type' => 'income','icon_id' => 9,]);

            // 4. Membuat Parties Default untuk Book
            $book->parties()->create(['name' => 'Vendor','icon_id' => 10,]);
            $book->parties()->create(['name' => 'Customer','icon_id' => 11,]);
            $book->parties()->create(['name' => 'Bank','icon_id' => 12,]);
        });
    }
    // Total Nominal
    // key [date]
    // public function totalTransactionInDate($date) {
    //     return $this->records()->wheres(['type'=>'income', 'date'=>$date])->sum('nominal')
    //     - $this->records()->wheres(['type'=>'expense', 'date'=>$date])->sum('nominal');
    // }
    // public function totalTransferInDate($date) {
    //     return $this->records()->wheres(['type'=>'transfer', 'date'=>$date])->sum('nominal');
    // }
    // public function totalAccount(Array $filter) {
    //     return $this->accounts()->wheres($filter)->sum(function($account){
    //         return $account->lastNominal();
    //     });
    // }


    

    // RELASI
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function icon() {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function records() {
        return $this->hasMany(TransactionRecord::class, 'book_id');
    }
    
    public function categories(){
        return $this->hasMany(TransactionCategory::class, 'book_id');
    }
    
    public function parties(){
        return $this->hasMany(TransactionParty::class, 'book_id');
    }
    
    public function accounts(){
        return $this->hasMany(Account::class, 'book_id');
    }
}


