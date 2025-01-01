<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Icon;
use App\Models\TransactionRecord;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    protected $guarded = ['id'];

    public function icon() {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function records() {
        return $this->hasMany(TransactionRecord::class, 'category_id');
    }

    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }


    // SCOPE
    public function scopeFilterByType($query, $type) {
        return $query->where('type', $type);
    }

}
