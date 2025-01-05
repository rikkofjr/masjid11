<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelompokTransaksi extends Model
{
    use HasUuids, SoftDeletes;
    protected $table = 'tb_kelompok_transaksi';
    protected $fillable = [
        'nama',
        'nomor_kelompok_kas',
        'id_penanggung_jawab'
    ];
}
