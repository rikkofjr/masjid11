<?php

namespace App\Models\Jamaah;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JamaahNama extends Model
{
    use HasUuids, SoftDeletes ;
    protected $table = 'tb_jamaah_nama';
    protected $fillable = [
        'id_jamaah_keluarga',
        'nama_jamaah',
        'tanggal_lahir',
        'id_penanggung_jawab',
    ];

    public function jamaah_keluarga(){
        return $this->belongsTo(JamaahKeluarga::class, 'id');
    }
}
