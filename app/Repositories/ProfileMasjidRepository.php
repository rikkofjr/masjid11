<?php
namespace App\Repositories;

use App\Models\ProfileMasjid;
use Illuminate\Support\Collection;

class ProfileMasjidRepository implements ProfileMasjidRepositoryInterface{

    public function first(): ? ProfileMasjid
    {
        return ProfileMasjid::first();
    }
}