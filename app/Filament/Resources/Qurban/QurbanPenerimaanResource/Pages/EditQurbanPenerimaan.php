<?php

namespace App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;

use App\Filament\Resources\Qurban\QurbanPenerimaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQurbanPenerimaan extends EditRecord
{
    protected static string $resource = QurbanPenerimaanResource::class;

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
