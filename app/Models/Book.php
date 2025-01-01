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

    // relasi
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


