<?php

namespace App\Models\TaskNode;

use App\Models\User;
use App\Models\TaskNode\Assignment;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model{
    // Tentukan nama tabel dengan prefix "tn"
    protected $table = 'tn_classroom';

    protected $guarded = ['id'];

    public function countUser(){
        return $this->users->count();
    }


    
    
    // RELASI
    public function assignments() {
        return $this->hasMany(Assignment::class);
    }
    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }
    // Relasi many-to-many ke pengguna yang bergabung di kelas melalui tabel pivot
    public function users(){
        return $this->belongsToMany(User::class, 'user_classrooms', 'class_room_id', 'user_id')
        ->withTimestamps();
    }
    // SCOPE

    public function scopeSkip($query, $userId){
        return $query->whereDoesntHave('users', function ($subQuery) use ($userId) {
            $subQuery->where('user_id', $userId);
        });
    }

    public function scopeFilter($query, $filter){
        // Pastikan $filter berupa array
        $filter = is_array($filter) ? $filter : $filter->all();
        
        // code
        $query->when(isset($filter['code']) ? $filter['code'] : false, function($query, $code){
            return $query->where('code', $code);
        });

        // name
        $query->when(isset($filter['name']) ? $filter['name'] : false, function($query, $name){
            return $query->where('name', $name);
        });

        return $query;
    }
}
