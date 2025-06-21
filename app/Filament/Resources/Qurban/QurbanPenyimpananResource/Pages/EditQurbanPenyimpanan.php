<?php

namespace App\Filament\Resources\Qurban\QurbanPenyimpananResource\Pages;

use App\Filament\Resources\Qurban\QurbanPenyimpananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQurbanPenyimpanan extends EditRecord
{
    protected static string $resource = QurbanPenyimpananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
