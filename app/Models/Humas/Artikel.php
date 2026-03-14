<?php

namespace App\Models\Humas;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    Use SoftDeletes;

    protected $table = 'tb_artikel';
    protected $fillable = [
        'judul_artikel',
        'deskripsi',
        'photo',
        'petugas',
        'is_active'
    ];

    public function profile_petugas(){
        return $this->belongsTo(User::class, 'petugas');
    }
}
