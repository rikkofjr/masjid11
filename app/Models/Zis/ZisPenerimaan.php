<?php

namespace App\Models\Zis;

use App\Models\Bendahara\JenisPembayaran;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZisPenerimaan extends Model
{
    use HasUuids, SoftDeletes;
    protected $table = 'tb_zis_penerimaan';
    protected $fillable = [
        'amil',
        'amil_editor',
        'id_jenis_zis',
        'atas_nama',
        'nama_lain',
        'jumlah_jiwa',
        'uang',
        'uang_infaq',
        'total_tagihan',
        'beras',
        'beras_infaq',
        'snap_token',
        'id_jenis_pembayaran',
        'hijri',
        'status_pembayaran'
    ];


    public function nama_amil(){
        return $this->belongsTo(User::class, 'amil');
    }
    
    public function jenis_zis(){
        return $this->belongsTo(JenisZis::class, 'id_jenis_zis');
    }
    public function jenis_pembayaran(){
        return $this->belongsTo(JenisPembayaran::class, 'id_jenis_pembayaran');
    }
}
