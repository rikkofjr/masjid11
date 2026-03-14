<?php

namespace App\Models\Bendahara;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiKas extends Model
{
    use HasUuids , SoftDeletes;
    protected $table = 'tb_transaksi_kas';
    protected $fillable = [
        'keterangan',
        'keterangan_tambahan',
        'id_kelompok_transaksi',
        'id_jenis_pembayaran',
        'penerimaan',
        'pengeluaran',
        'tipe',
        'petugas'
    ];

    public function kelompok_transaksi(){
        return $this->belongsTo(KelompokTransaksi::class, 'id_kelompok_transaksi');
    }
    public function profile_petugas(){
        return $this->belongsTo(User::class, 'petugas');
    }
    public function jenis_pembayaran(){
        return $this->belongsTo(JenisPembayaran::class, 'id_jenis_pembayaran');
    }
}
