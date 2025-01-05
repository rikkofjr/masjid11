<?php

namespace App\Livewire\Layanan;

use App\Models\Zis\ZisPenerimaan;
use Livewire\Component;

class ConfirmPembayaranZis extends Component
{
    public $id;
    public $snapToken;

    public function mount($id, $snapToken)
    {
        $this->snapToken = $snapToken;
        $this->id = ZisPenerimaan::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.layanan.confirm-pembayaran-zis')->layout('components.layouts.layanan');
    }
}
