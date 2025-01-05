<?php

namespace App\Models\MoneyNode;

use App\Models\MoneyNode\Book;
use App\Models\Icon;
use App\Models\MoneyNode\TransactionRecord;
use Illuminate\Database\Eloquent\Model;

class TransactionParty extends Model
{
    protected $guarded = ['id'];

    // Tentukan nama tabel dengan prefix "mn"
    protected $table = 'mn_transaction_parties';

    public static function booted(){
        static::created(function ($party){
            $party->book->user->logs()->create([
                'model' => 'MoneyNode(party)',
                'action' => 'create',
                'data' => [
                    'after' => $party->toArray(),
                ],
            ]);
        });
    }


    // Relasi
    public function icon() {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function records() {
        return $this->hasMany(TransactionRecord::class, 'party_id');
    }
    
    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }

}
