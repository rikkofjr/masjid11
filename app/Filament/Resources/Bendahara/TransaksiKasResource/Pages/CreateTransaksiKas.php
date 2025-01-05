<?php

namespace App\Filament\Resources\Bendahara\TransaksiKasResource\Pages;

use App\Filament\Resources\Bendahara\TransaksiKasResource;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Bendahara\KelompokTransaksi;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaksiKas extends CreateRecord
{
    protected static string $resource = TransaksiKasResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if($data['tipe'] == 'penerimaan'){
            $data['penerimaan'] = $data['uang'];
        }
        if($data['tipe'] == 'pengeluaran'){
            $data['pengeluaran'] = $data['uang'];
        }
        $data['id_penanggung_jawab'] = auth()->id();
    
        return $data;
    }

    
}
