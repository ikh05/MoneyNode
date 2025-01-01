<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Icon;
use App\Models\TransactionRecord;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = ['id'];
    
    public function lastSaldo(){
        return $this->first_nominal
        + $this->records()->where('type', 'income')->sum('nominal')
        - $this->records()->where('type', 'expense')->sum('nominal')
        + $this->transfersToMe()->sum('nominal')
        - $this->transfersFromMe()->sum('nominal');
    }
    
    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }
    
    public function icon() {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function records() {
        return $this->hasMany(TransactionRecord::class, 'account_id');
    }

    public function transfersFromMe() {
        return $this->hasMany(TransactionRecord::class, 'from_account_id');
    }

    public function transfersToMe() {
        return $this->hasMany(TransactionRecord::class, 'to_account_id');
    }
    
    
}
