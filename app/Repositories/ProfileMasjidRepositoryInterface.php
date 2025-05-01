<?php

namespace App\Repositories;

use App\Models\ProfileMasjid;
use Illuminate\Support\Collection;

interface ProfileMasjidRepositoryInterface {

    // public function findById($id): ? ProfileMasjid;

    public function first() : ?ProfileMasjid;
}