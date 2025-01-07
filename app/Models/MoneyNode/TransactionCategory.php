<?php

namespace App\Models\MoneyNode;

use App\Models\Icon;
use App\Models\MoneyNode\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Database\Eloquent\Model;
use App\Models\MoneyNode\TransactionRecord;

class TransactionCategory extends Model
{
    protected $guarded = ['id'];

    // Tentukan nama tabel dengan prefix "mn"
    protected $table = 'mn_transaction_categories';
    
    public static function booted(){
        static::created(function ($category){
            $user = Auth::user();
            if($user->skip_log){
                $category->book->user->logs()->create([
                    'model' => 'MoneyNode(category)',
                    'action' => 'create',
                    'data' => [
                        'after' => $category->toArray(),
                    ],
                ]);
            }
        });
    }

    
    // RELASI
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
