<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    use HasUuids;
    protected $table = 'tb_jenis_pembayaran';
    protected $fillable = [
        'nama',
        'short_name',
        'is_active'
    ];
}
