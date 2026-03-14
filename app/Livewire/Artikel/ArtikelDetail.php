<?php

namespace App\Livewire\Artikel;

use App\Models\Humas\Artikel;
use Livewire\Component;

class ArtikelDetail extends Component
{
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.artikel.artikel-detail');
    }
}
