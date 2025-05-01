<?php

namespace App\Models\Humas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $table = 'tb_program_masjid';
    protected $fillable = [
        'judul_program',
        'deskripsi',
        'photo',
        'is_active',
    ];
}
