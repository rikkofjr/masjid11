<?php

namespace App\Filament\Resources\Profile\ProfileMasjidResource\Pages;

use App\Filament\Resources\Profile\ProfileMasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfileMasjid extends EditRecord
{
    protected static string $resource = ProfileMasjidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
