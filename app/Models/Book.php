<?php

namespace App\Models;

use App\Models\Icon;
use App\Models\User;
use App\Models\Account;
use App\Models\TransactionParty;
use App\Models\TransactionRecord;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNumeric;

class Book extends Model
{
    protected $guarded = ['id'];

    protected static function booted(){
        static::created(function ($book) {
            // 2. Membuat Account Default untuk User
            $book->accounts()->create(['name' => 'Cash','first_nominal' => 10000,'currency' => 'IDR','icon_id' => 13,'type'=>'cash',]);
            $book->accounts()->create(['name' => 'Tabungan','first_nominal' => 0,'currency' => 'IDR','icon_id' => 14,'type'=>'virtual',]);
            $book->accounts()->create(['name' => 'Hutang','first_nominal' => 0,'currency' => 'IDR','icon_id' => 15,'type'=>'hutang',]);
            $book->accounts()->create(['name' => 'Piutang','first_nominal' => 0,'currency' => 'IDR','icon_id' => 15,'type'=>'piutang',]);

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


