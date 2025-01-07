<?php

namespace App\Models\TaskNode;

use App\Models\TaskNode\ClassRoom;
use App\Models\TaskNode\TaskRecord;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {
    // Tentukan nama tabel dengan prefix "tn"
    protected $table = 'tn_assignments';

    protected $guarded = ['id'];

    protected static function booted(){

        static::creating(function ($assignment){
        });
        static::created(function ($assignment) {
            $users = $assignment->classRoom->users;
            foreach ($users as $user) {
                $user->logs()->create([
                    'model' => 'TaskNode(Assignment)',
                    'action' => 'create',
                    'data' => [
                        'after' => $assignment,
                    ],
                ]);
            }
        });
    }


    // RELASI
    public function classRoom(){
        return $this->belongsTo(ClassRoom::class);
    }

    // Relasi ke TaskRecord (One to Many)
    public function records(){
        return $this->hasMany(TaskRecord::class);
    }
    
}
