<?php

namespace App\Http\Controllers\Qurban;

use App\Http\Controllers\Controller;
use App\Models\ProfileMasjid;
use App\Models\Qurban\QurbanPenerimaan;
use App\Repositories\ProfileMasjidRepositoryInterface;
use Illuminate\Http\Request;

class QurbanController extends Controller
{

    public function __construct(ProfileMasjidRepositoryInterface $ProfileMasjidRepository)
    {
        $this->ProfileMasjidRepository = $ProfileMasjidRepository;
    }

    protected $ProfileMasjidRepository;

    public function print($id){
        $data = QurbanPenerimaan::with('nama_amil')->findOrFail($id);
        // $profileMasjid = ProfileMasjid::where('is_active', true)->orderby('created_at, 'desc')->limit(1);
        $profileMasjid = $this->ProfileMasjidRepository->first();

        return view('print.print-qurban-detail', compact('data', 'profileMasjid'));
    }

}
