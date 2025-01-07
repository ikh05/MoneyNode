<?php

namespace App\Models\MoneyNode;

use App\Models\Icon;
use App\Models\MoneyNode\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\MoneyNode\TransactionRecord;

class Account extends Model
{
    // Tentukan nama tabel dengan prefix "mn"
    protected $table = 'mn_accounts';

    protected $guarded = ['id'];
    
    protected static function booted(){
        static::creating(function ($asset) {
            // $book->accounts()->create(['name' => 'Cash','first_nominal' => 0,'currency' => 'IDR','icon_id' => 13,'type'=>'cash',]);
            // jika type hutang, maka paksa jangan masukkan ke asset (is_asset = false); 
            // DIPERTIMBANGKAN
            // if($asset->type === 'hutang') $asset->is_asset = false;
        });

        static::created(function ($account){
            $user = Auth::user();
            if($user->skip_log){
                $account->book->user->logs()->create([
                    'model' => 'MoneyNode(account)',
                    'action' => 'create',
                    'data' => [
                        'after' => $account->toArray(),
                    ],
                ]);
            }
        });
    }

    // Scoop
    public function scopeWheres($query, Array $where){
        // isAdmin
        $query->when(isset($where['isAsset']) ? $where['isAsset'] : false, function($query, $isAsset){
            return $query->where('isAsset', $isAsset);
        });
        // type
        $query->when(isset($where['type']) ? $where['type'] : false, function($query, $type){
            return $query->where('type', $type);
        });
    }

    
    // RELASI
    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }
    
    public function icon() {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function records() {
        return $this->hasMany(TransactionRecord::class, 'account_id');
    }

    public function transferFromMe() {
        return $this->hasMany(TransactionRecord::class, 'from_account_id');
    }

    public function transferToMe() {
        return $this->hasMany(TransactionRecord::class, 'to_account_id');
    }
    
    
}
