<?php

namespace App\Livewire\Layanan\Qurban;

use App\Models\Qurban\QurbanPenerimaan;
use App\Models\Qurban\QurbanTracking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class QurbanDetail extends Component
{
    use LivewireAlert; 

    public $penerimaan;
    public $showTracking = false;

    public function mount($id)
    {
        $this->penerimaan = QurbanPenerimaan::with('trackings')->findOrFail($id);
    }

    public function nextStatus()
    {
        $statuses = ['diterima', 'disembelih', 'diproses', 'terkirim'];
        $currentIndex = array_search($this->penerimaan->status_terakhir, $statuses);

        if ($currentIndex !== false && $currentIndex < count($statuses) - 1) {
            $nextStatus = $statuses[$currentIndex + 1];

            QurbanTracking::create([
                'id_qurban_penerimaan' => $this->penerimaan->id,
                'status' => $nextStatus,
                'petugas' => auth()->user()->id ?? 'Petugas', // pastikan ada field petugas_nama di tabel tracking
                'waktu' => now(),
            ]);

            $this->penerimaan->update([
                'status_terakhir' => $nextStatus
            ]);

            // session()->flash('message', 'Status berhasil diperbarui.');
            // $this->penerimaan->refresh();

            $this->alert('success', "Berhasil update status menjadi {$nextStatus}");
        }
    }

    public function openTracking()
    {
        $this->showTracking = true;
    }
    public function render()
    {
        return view('livewire.layanan.qurban.qurban-detail')->layout('components.layouts.layanan');
    }
}

