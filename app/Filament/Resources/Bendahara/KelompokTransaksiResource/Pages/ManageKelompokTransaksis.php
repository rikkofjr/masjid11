<?php

namespace App\Filament\Resources\Bendahara\KelompokTransaksiResource\Pages;

use App\Filament\Resources\Bendahara\KelompokTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKelompokTransaksis extends ManageRecords
{
    protected static string $resource = KelompokTransaksiResource::class;
    protected static ?string $title = 'Kelompok Transaksi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
