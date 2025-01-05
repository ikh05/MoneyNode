<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Symfony\Component\Console\Descriptor\Descriptor;

class Log extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    

    protected static function booted(){
        parent::boot();

        static::creating(function($data) {
            // mencegah log disimpan saat skip
            $user = Auth::user();
            if($user && $user->skip_log === 0){
                return false; 
            }

            // data berisi model, action, data
            switch ($data->action) {
                case 'create':
                    if($data->model === 'MoneyNode(book)') $data->description = "Memnuat buku: ".$data->data['after']['name']; 
                    if($data->model === 'MoneyNode(account)') $data->description = "Menambahkan akun: ".$data->data['after']['name']; 
                    if($data->model === 'MoneyNode(party)') $data->description = "Menambahkan subjek: ".$data->data['after']['name']; 
                    if($data->model === 'MoneyNode(category)') $data->description = "Menambahkan kategori: ".$data->data['after']['name']; 
                    if($data->model === 'MoneyNode(transaction)') $data->description = "Menambahkan transaksi: ".$data->data['after']['type']; 
                    if($data->model === 'user') $data->description = "Membuat user: ".$data->data['after']['username']; 
                    break;
                
                case 'delete':
                    if($data->model === 'MoneyNode(book)') $data->description = "Buku: ".$data->data['before']['name'].' telah di hapus'; 
                    if($data->model === 'MoneyNode(account)') $data->description = "Akun: ".$data->data['before']['name'].' telah di hapus'; 
                    if($data->model === 'MoneyNode(party)') $data->description = "Subjek: ".$data->data['before']['name'].' telah di hapus'; 
                    if($data->model === 'MoneyNode(category)') $data->description = "Kategori: ".$data->data['before']['name'].' telah di hapus'; 
                    if($data->model === 'MoneyNode(transaction)') $data->description = "Transaction: ".$data->data['before']['type'].' telah di hapus'; 
                    if($data->model === 'user') $data->description = "User: ".$data->data['before']['username'].' telah di hapus'; 
                    break;

                case 'update':

                default:
                    $data->description = 'Terdapat perubahan pada akun anda';
            }
            $data->data = json_encode($data->data);
        });
    }

    // RELASI
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
