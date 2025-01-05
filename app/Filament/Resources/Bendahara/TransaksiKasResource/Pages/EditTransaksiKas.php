<?php

namespace App\Filament\Resources\Bendahara\TransaksiKasResource\Pages;

use App\Filament\Resources\Bendahara\TransaksiKasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiKas extends EditRecord
{
    protected static string $resource = TransaksiKasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
    protected function mutateFormDataBeforeUpdate(array $data): array
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
