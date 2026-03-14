<?php

namespace App\Models\Qurban;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QurbanPenerimaan extends Model
{
    use HasUuids, SoftDeletes;
    protected $table = "tb_qurban_penerimaan";
    protected $fillable = [
        'id',
        'petugas',
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
        'status_terakhir',
        'photo_hewan',

    ];

    public function profile_petugas(){
        return $this->belongsTo(User::class, 'petugas');
    }

    public function trackings(){
        return $this->hasMany(QurbanTracking::class, 'id_qurban_penerimaan', 'id')->orderBy('created_at', 'desc');
    }

}
