<?php

namespace App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;

use App\Filament\Resources\Qurban\QurbanPenerimaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQurbanPenerimaan extends ViewRecord
{
    protected static string $resource = QurbanPenerimaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
