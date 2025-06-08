<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileMasjid extends Model
{
    protected $table = 'tb_profile_masjid';
    protected $fillable = [
        'nama_masjid',
        'alamat_masjid',
        'no_handphone',
        'deskripsi',
        'logo',
        'is_active'
    ];
}
