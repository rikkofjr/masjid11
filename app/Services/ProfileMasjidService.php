<?php

namespace App\Services;

use App\Models\ProfileMasjid;

class ProfileMasjidService{

    public function getProfileMasjid(){

        return ProfileMasjid::first();
        
    }

}