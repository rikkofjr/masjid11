<?php

namespace App\Models\Humas;

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
        'is_active'
    ];
}
