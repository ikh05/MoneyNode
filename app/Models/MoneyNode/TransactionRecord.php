<?php

namespace App\Models\MoneyNode;

use App\Models\MoneyNode\Book;
use App\Models\MoneyNode\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\MoneyNode\TransactionParty;
use App\Models\MoneyNode\TransactionCategory;


class TransactionRecord extends Model{

    protected $guarded = ['id'];

    // Tentukan nama tabel dengan prefix "mn"
    protected $table = 'mn_transaction_records';
    
    public static function booted(){
        static::created(function ($transaction){
            $user = Auth::user();
            if($user->skip_log){
                $transaction->book->user->logs()->create([
                    'model' => 'MoneyNode(transaction)',
                    'action' => 'create',
                    'data' => [
                        'after' => $transaction->toArray(),
                    ],
                ]);
            }
        });
    }

    // scope
    public function scopeWheres($query, Array $where){
        // date
        $query->when(isset($where['date']) ? $where['date'] : false, function($query, $date){
            return $query->where('date', $date);
        });

        // type
        $query->when(isset($where['type']) ? $where['type'] : false, function($query, $type){
            if(is_array($type)) return $this->wheres($type);
            return $query->where('type', $type);
        });
    }

    // relasi
    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function category() {
        return $this->belongsTo(TransactionCategory::class, 'category_id');
    }

    public function party() {
        return $this->belongsTo(TransactionParty::class, 'party_id');
    }

    public function transferFrom() {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function transferTo() {
        return $this->belongsTo(Account::class, 'to_account_id');
    }
}
