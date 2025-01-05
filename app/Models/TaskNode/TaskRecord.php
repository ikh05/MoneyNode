<?php

namespace App\Models\TaskNode;

use App\Models\User;
use App\Models\TaskNode\Assignment;
use Illuminate\Database\Eloquent\Model;

class TaskRecord extends Model{

    // Tentukan nama tabel dengan prefix "tn"
    protected $table = 'tn_task_records';

    protected $guarded = ['id'];
    
    // RELASI
    public function assignment(){
        return $this->belongsTo(Assignment::class);
    }

    // Relasi ke User (Many to One)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
