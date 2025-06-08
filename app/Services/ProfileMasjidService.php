<?php

namespace App\Services;

use App\Models\ProfileMasjid;

class ProfileMasjidService{

    public function getProfileMasjid(){

        return ProfileMasjid::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->first();
        
    }

}