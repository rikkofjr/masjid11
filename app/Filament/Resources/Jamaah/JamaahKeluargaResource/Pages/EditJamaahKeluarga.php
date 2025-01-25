<?php

namespace App\Filament\Resources\Jamaah\JamaahKeluargaResource\Pages;

use App\Filament\Resources\Jamaah\JamaahKeluargaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJamaahKeluarga extends EditRecord
{
    protected static string $resource = JamaahKeluargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
