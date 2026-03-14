<?php

namespace App\Livewire;

use App\Models\Humas\Agenda;
use Livewire\Component;

class AgendaCalendar extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = Agenda::all()->map(function ($agenda) {
            return [
                'id'    => $agenda->id,
                'title' => $agenda->nama_agenda,
                'start' => $agenda->tanggal . 'T' . $agenda->jam_mulai,
                'end'   => $agenda->tanggal . 'T' . $agenda->jam_selesai,
                'extendedProps' => [
                    'petugas' => $agenda->petugas,
                    'status'  => $agenda->status,
                    'catatan' => $agenda->catatan,
                ]
            ];
        });
    }

    public function render()
    {
        return view('livewire.agenda-calendar');
    }
}

