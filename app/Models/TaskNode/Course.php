<?php

namespace App\Models\TaskNode;

use App\Models\User;
use App\Models\TaskNode\Assignment;
use Illuminate\Database\Eloquent\Model;

class Course extends Model{
    // Tentukan nama tabel dengan prefix "tn"
    protected $table = 'tn_courses';

    protected $guarded = ['id'];

    // RELASI
    // Relasi ke Assignment (One to Many)
    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    // Relasi ke User melalui tabel pivot user_courses (Many to Many)
    public function users() {
        return $this->belongsToMany(User::class, 'user_courses')
                    ->withTimestamps(); // Menyertakan timestamps pada pivot
    }
}
