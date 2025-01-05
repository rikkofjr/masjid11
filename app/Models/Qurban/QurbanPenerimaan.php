<?php

namespace App\Models\Qurban;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QurbanPenerimaan extends Model
{
    use HasUlids, SoftDeletes;
    protected $table = "tb_qurban_penerimaan";
    protected $fillable = [
        'id',
        'amil',
        'jenis_hewan',
        'atas_nama',
        'nama_lain',
        'alamat',
        'permintaan',
        'nomor_handphone',
        'disaksikan',
        'keterangan',
        'hijri',
        'nomor_hewan',
        'photo_hewan',

    ];

}
