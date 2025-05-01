<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    protected $table = 'tb_displays';
    protected $fillable = [
        'photo_display',
        'keterangan',
        'is_active'
    ];
}
