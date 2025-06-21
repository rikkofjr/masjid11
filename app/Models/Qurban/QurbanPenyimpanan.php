<?php

namespace App\Models\Qurban;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QurbanPenyimpanan extends Model
{
    use HasUuids, SoftDeletes;
    protected $table = "tb_qurban_penyimpanan";
    protected $fillable = [
        'id',
        'nama_gudang_penyimpanan',
    ];

    public function stock()
    {
        return $this->hasMany(QurbanStock::class, 'id_qurban_penyimpanan', 'id');
    }
}
