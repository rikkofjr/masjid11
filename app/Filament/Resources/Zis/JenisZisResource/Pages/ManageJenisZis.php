<?php

namespace App\Filament\Resources\Zis\JenisZisResource\Pages;

use App\Filament\Resources\Zis\JenisZisResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisZis extends ManageRecords
{
    protected static string $resource = JenisZisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
