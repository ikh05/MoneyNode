<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function createRecord($data){
        self::create([
            'action' => 'create',
            'model' => 'Record',
            'data' => json_encode([
                "after" => json_encode($data), 
            ]),
            // Username Ikhsan(id.user), success create transaction income at  
            'description' => 'Username '.Auth::user()->username.'('.Auth::user()->id.'), success create transaction '.$data->type.'('.$data->id.') at '.$data->created_at,
        ]);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
