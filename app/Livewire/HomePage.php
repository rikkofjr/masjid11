<?php

namespace App\Livewire;

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
        $profileMasjid = $this->ProfileMasjidRepository->first();
        return view('livewire.home-page', compact('profileMasjid', 'programMasjid'));
    }
}
