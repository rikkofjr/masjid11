<?php

namespace App\Livewire\Artikel;

use App\Models\Humas\Artikel;
use Livewire\Component;
use Livewire\WithPagination;

class ArtikelIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind'; // kalau pakai Tailwind

    public function render()
    {
        $artikelsMasjid = Artikel::orderBy('created_at', 'desc')->paginate(1);
        return view('livewire.artikel.artikel-index', compact('artikelsMasjid'));
    }
}
