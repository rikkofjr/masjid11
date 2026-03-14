<?php

namespace App\Livewire;

use App\Models\Humas\Artikel;
use App\Models\Humas\Program;
use App\Repositories\ProfileMasjidRepositoryInterface;
use Livewire\Component;

class HomePage extends Component
{
    protected $ProfileMasjidRepository;
    public function mount(ProfileMasjidRepositoryInterface $ProfileMasjidRepository)
    {
        $this->ProfileMasjidRepository = $ProfileMasjidRepository;
    }

    public function render()
    {
        
        $programMasjid = Program::all()->where('is_active', true);
        $artikelMasjid = Artikel::orderBy('created_at', 'desc')->limit(6)->get();
        $profileMasjid = $this->ProfileMasjidRepository->first();
        $title = 'Website Resmi '. $profileMasjid->nama_masjid;

        return view('livewire.home-page', compact(
            'profileMasjid', 
            'programMasjid', 
            'artikelMasjid',
            'title',
        ));
    }
}
