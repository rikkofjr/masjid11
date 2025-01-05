<?php

namespace App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;

use App\Filament\Resources\Zis\ZisPenerimaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewZisPenerimaan extends ViewRecord
{
    protected static string $resource = ZisPenerimaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
