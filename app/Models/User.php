<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Log;
use App\Models\Book;
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
    public function __default(){
        // Memastikan fungsi hanya dijalankan jika pengguna belum memiliki data default
        if ($this->books()->exists()) {
            return; // Jika user sudah memiliki buku, akun, kategori, dan party, abaikan fungsi ini
        }

        // 1. Membuat Book Default untuk User
        $book = $this->books()->create(['name' => 'Default Book','description' => 'Buku pertama untuk pencatatan','icon_id' => 1,]);

        // 2. Membuat Account Default untuk User
        $book->accounts()->create(['name' => 'Cash','first_nominal' => 10000,'currency' => 'IDR','icon_id' => 13,'type'=>'cash',]);
        $book->accounts()->create(['name' => 'Tabungan','first_nominal' => 0,'currency' => 'IDR','icon_id' => 14,'type'=>'virtual',]);
        $book->accounts()->create(['name' => 'Hutang','first_nominal' => 0,'currency' => 'IDR','icon_id' => 15,'type'=>'hutang',]);
        $book->accounts()->create(['name' => 'Piutang','first_nominal' => 0,'currency' => 'IDR','icon_id' => 15,'type'=>'piutang',]);

        // 3. Membuat Category Default untuk Book (Pengeluaran dan Pemasukan)
        // Kategori Pengeluaran (Expense)
        $book->categories()->create(['name' => 'Food','type' => 'expense','icon_id' => 2,]);
        $book->categories()->create(['name' => 'Transportation','type' => 'expense','icon_id' => 3,]);
        $book->categories()->create(['name' => 'Utilities','type' => 'expense','icon_id' => 4,]);
        $book->categories()->create(['name' => 'Entertainment','type' => 'expense','icon_id' => 5,]);
        $book->categories()->create(['name' => 'Health','type' => 'expense','icon_id' => 6,]);

        // Kategori Pemasukan (Income)
        $book->categories()->create(['name' => 'Salary','type' => 'income','icon_id' => 7,]);
        $book->categories()->create(['name' => 'Investment','type' => 'income','icon_id' => 8,]);
        $book->categories()->create(['name' => 'Gift','type' => 'income','icon_id' => 9,]);

        // 4. Membuat Parties Default untuk Book
        $book->parties()->create(['name' => 'Vendor','icon_id' => 10,]);
        $book->parties()->create(['name' => 'Customer','icon_id' => 11,]);
        $book->parties()->create(['name' => 'Bank','icon_id' => 12,]);
        $this->logs()->create(['action' => 'create','model' => 'user','data' => json_encode([    "after" => json_encode($this), ]),'description' => 'Create user '.$this->name.' at '.date(today()),]);
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
