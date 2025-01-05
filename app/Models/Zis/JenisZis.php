<?php

namespace App\Models\Zis;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisZis extends Model
{
    
    use HasUuids , SoftDeletes;

    protected $table = 'tb_jenis_zis';
    protected $fillable = [
        'nama',
        'short_name'
    ];

    public function zakat(){
        return $this->hasMany(PembayaranZis::class, 'id_jenis_zis');
    }

}
