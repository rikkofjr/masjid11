<?php

namespace App\Filament\Resources\Humas\AgendaResource\Pages;

use App\Filament\Resources\Humas\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgenda extends CreateRecord
{
    protected static string $resource = AgendaResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set data tambahan otomatis
        $data['petugas'] = auth()->user()->id;

        return $data;
    }


}
