<?php

namespace App\Models\Humas;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'tb_agenda';
    protected $fillable = [
        'nama_agenda',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'petugas',
        'catatan',
        'status',
    ];
}
