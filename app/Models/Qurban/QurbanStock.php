<?php

namespace App\Models\Qurban;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QurbanStock extends Model
{
    use HasUuids, SoftDeletes;
    protected $table = "tb_qurban_stock";
    protected $fillable = [
        'id',
        'kuantitas',
        'status',
        'hijri',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
