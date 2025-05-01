<?php

namespace App\Filament\Resources\Profile\ProfileMasjidResource\Pages;

use App\Filament\Resources\Profile\ProfileMasjidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfileMasjids extends ListRecords
{
    protected static string $resource = ProfileMasjidResource::class;
    protected static ?string $title = 'Profile Masjid';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
