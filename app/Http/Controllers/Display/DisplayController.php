<?php

namespace App\Http\Controllers\Display;

use App\Http\Controllers\Controller;
use App\Models\Display;
use App\Repositories\ProfileMasjidRepositoryInterface;
use Illuminate\Http\Request;

class DisplayController extends Controller
{

    public function __construct(ProfileMasjidRepositoryInterface $ProfileMasjidRepository)
    {
        $this->ProfileMasjidRepository = $ProfileMasjidRepository;
    }

    protected $ProfileMasjidRepository;

    public function index(){
        $profileMasjid = $this->ProfileMasjidRepository->first();
        $photoDisplay = Display::all()->where('is_active', true);
        $photoDisplayFirst = Display::where('is_active', true)->first();
        // dd($photoDisplayFirst);
        return view('display.display-1', compact('profileMasjid', 'photoDisplayFirst','photoDisplay'));
    }
    public function display2(){
        $profileMasjid = $this->ProfileMasjidRepository->first();
        $photoDisplay = Display::all()->where('is_active', true);
        $photoDisplayFirst = Display::where('is_active', true)->first();
        // dd($photoDisplayFirst);
        return view('display.display-2', compact('profileMasjid', 'photoDisplayFirst','photoDisplay'));
    }
}
