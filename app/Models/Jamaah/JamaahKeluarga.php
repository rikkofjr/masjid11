<?php

namespace App\Models\Jamaah;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JamaahKeluarga extends Model
{
    use HasUuids, SoftDeletes ;
    protected $table = 'tb_jamaah_keluarga';
    protected $fillable = [
        'tipe',
        'status',
        'nama_keluarga',
        'alamat',
        'id_penanggung_jawab',
    ];

    public function jamaah_anggota_keluarga(){
        return $this->hasMany(JamaahNama::class, 'id_jamaah_keluarga');
    }
    
    public function penanggung_jawab(){
        return $this->belongsTo(User::class, 'id_penanggung_jawab');
    }
}
