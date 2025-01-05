<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Log;
use App\Models\Icon;
// use App\Models\TaskNode\Book as TaskNode_Book;
use App\Models\TaskNode\Course;
use App\Models\TaskNode\TaskRecord;
use Illuminate\Notifications\Notifiable;
use App\Models\MoneyNode\Book as MoneyNode_Book;
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
            $user->logs()->create([
                'action' => 'create',
                'model' => 'user',
                'data' => [
                    "after" => $user->toArray(),
                ]
            ]);
        });
    }

    // Log
    public function toggleLog($status = null) {
        // Pastikan bahwa kolom skip_log dapat diubah
        if ($this->skip_log !== null) {
            $this->skip_log = ($status === null ) ? !$this->skip_log : $status;
            $this->save();  // Simpan perubahan ke database
        } else {
            // Menangani kasus ketika kolom skip_log tidak ada atau null
            throw new \Exception("Kolom users.skip_log tidak ditemukan atau tidak valid.");
        }
    } 

    // RELASI
    public function uploader() {
        return $this->hasMany(Icon::class, 'uploader_id');
    }
    public function logs() {
        return $this->hasMany(Log::class, 'user_id');
    }

    public function mn_books() {
        return $this->hasMany(MoneyNode_Book::class, 'user_id');
    }


    public function courses() {
        return $this->belongsToMany(Course::class, 'user_courses')
                    ->withTimestamps(); // Menyertakan timestamps pada pivot
    }
    public function taskRecords() {
        return $this->hasMany(TaskRecord::class);
    }

}
