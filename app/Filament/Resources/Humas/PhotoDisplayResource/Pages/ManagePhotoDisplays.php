<?php

namespace App\Filament\Resources\Humas\PhotoDisplayResource\Pages;

use App\Filament\Resources\Humas\PhotoDisplayResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePhotoDisplays extends ManageRecords
{
    protected static string $resource = PhotoDisplayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
