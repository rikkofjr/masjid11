<?php

namespace App\Livewire\Partials;

use App\Repositories\ProfileMasjidRepositoryInterface;
use Livewire\Attributes\On;
use Livewire\Component;

class Footer extends Component
{
    protected $ProfileMasjidRepository;
    public function mount(ProfileMasjidRepositoryInterface $ProfileMasjidRepository)
    {
        $this->ProfileMasjidRepository = $ProfileMasjidRepository;
    }

    public function render()
    {
        $profileMasjid = $this->ProfileMasjidRepository->first();
        return view('livewire.partials.footer', compact('profileMasjid')) ;
    }
}