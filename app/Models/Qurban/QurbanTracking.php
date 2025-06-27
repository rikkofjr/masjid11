<?php

namespace App\Models\Qurban;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class QurbanTracking extends Model
{
    use HasUuids;
    protected $table = "tb_qurban_tracking";
    protected $fillable = [
        'id_qurban_penerimaan',
        'status',
        'keterangan',
        'petugas',
    ];

    public function profile_petugas(){
        return $this->belongsTo(User::class, 'petugas');
    }
}
