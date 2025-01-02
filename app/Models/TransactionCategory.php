<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Icon;
use App\Models\TransactionRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PhpParser\ErrorHandler\Collecting;

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
    public function scopeWheres($query, $where) {
        $query->when(isset($where['type']) ? $where['type'] : false, function($query, $type){
            // if(is_array($type)) dd($query->whre('type', implode(' OR ', $type))); 
            // return $query->where('type', implode(' OR ', $type));
            return $query->where('type', $type);
        });
    }

}
