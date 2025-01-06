<?php

namespace App\Models\TaskNode;

use App\Models\TaskNode\ClassRoom;
use App\Models\TaskNode\TaskRecord;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {
    // Tentukan nama tabel dengan prefix "tn"
    protected $table = 'tn_assignments';

    protected $guarded = ['id'];

    // RELASI
    public function classRoom(){
        return $this->belongsTo(ClassRoom::class);
    }

    // Relasi ke TaskRecord (One to Many)
    public function taskRecords()
    {
        return $this->hasMany(TaskRecord::class);
    }
    
}
