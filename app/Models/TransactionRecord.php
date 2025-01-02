<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Account;
use App\Models\TransactionParty;
use App\Models\TransactionCategory;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Transient;

use function PHPUnit\Framework\isArray;

class TransactionRecord extends Model{

    protected $guarded = ['id'];

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
