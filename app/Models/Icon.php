<?php

namespace App\Models;

use App\Models\MoneyNode\Book;
use App\Models\User;
use App\Models\MoneyNode\Account;
use App\Models\MoneyNode\TransactionParty;
use App\Models\MoneyNode\TransactionCategory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    
    protected $guarded = ['id'];
    

    public function uploader() {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function books() {
        return $this->hasMany(Book::class, 'icon_id');
    }

    public function accounts() {
        return $this->hasMany(Account::class, 'icon_id');
    }

    public function transactionCategories() {
        return $this->hasMany(TransactionCategory::class, 'icon_id');
    }

    public function transactionParties() {
        return $this->hasMany(TransactionParty::class, 'icon_id');
    }
    
}
