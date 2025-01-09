<?php

namespace App\Models\TaskNode;

use App\Models\User;
use App\Models\TaskNode\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TaskRecord extends Model{

    // Tentukan nama tabel dengan prefix "tn"
    protected $table = 'tn_task_records';

    protected $guarded = ['id'];
    
    protected static function booted(){
        static::created(function ($record) {
            Auth::user()->logs()->create([
                'model' => 'TaskNode(Record)',
                'action' => 'create',
                'data' => [
                    'after' => $record,
                ],
            ]);
        });
    }

    public function save (array $options = []){
        // Ambil data sebelum perubahan
        $originalAttributes = $this->getOriginal();

        // Simpan data
        $result = parent::save($options);

        $user = Auth::user();
        $user->logs()->create([
            'model' => 'TaskNode(Record)',
            'action' => 'update',
            'data' => [
                'after' => $this->getAttributes(),
                'before' => $originalAttributes,
            ],
        ]);
        return $result;
    }

    // RELASI
    public function assignment(){
        return $this->belongsTo(Assignment::class);
    }

    // Relasi ke User (Many to One)
    public function user(){
        return $this->belongsTo(User::class);
    }
}
