<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Log;
use App\Models\MoneyNode\Book;
use App\Models\Icon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Fungsi untuk menambahkan data default ketika user pertama kali dibuat
    protected static function booted(){
        static::created(function($user) {
            // Memastikan fungsi hanya dijalankan jika pengguna belum memiliki data default
            if ($user->books()->exists()) {
                return  0; // Jika user sudah memiliki buku, akun, kategori, dan party, abaikan fungsi ini
            }
            // 1. Membuat Book Default untuk User
            $user->books()->create(['name' => 'Default Book','description' => 'Buku pertama untuk pencatatan']);
            $user->books()->create(['name' => 'Buku Kedua','description' => 'Buku pertama untuk pencatatan','icon_id' => 1,]);
            $user->logs()->create(['action' => 'create','model' => 'user','data' => json_encode(["after" => json_encode($user), ]),'description' => 'Create user '.$user->name.' at '.date(today()),]);
        });
    }
    
    // RELASI
    public function uploader() {
        return $this->hasMany(Icon::class, 'uploader_id');
    }

    public function books() {
        return $this->hasMany(Book::class, 'user_id');
    }

    // public function accounts() {
    //     return $this->hasMany(Account::class);
    // }

    // public function categories() {
    //     return $this->hasMany(TransactionCategory::class);
    // }

    // public function parties() {
    //     return $this->hasMany(TransactionParty::class);
    // }

    // public function transactionRecords() {
    //     return $this->hasMany(TransactionRecord::class);
    // }

    public function logs() {
        return $this->hasMany(Log::class, 'user_id');
    }
}
