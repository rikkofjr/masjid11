<?php

namespace App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;

use App\Filament\Resources\Zis\ZisPenerimaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZisPenerimaan extends EditRecord
{
    protected static string $resource = ZisPenerimaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
