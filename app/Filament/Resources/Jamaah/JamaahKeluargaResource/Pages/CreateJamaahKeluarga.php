<?php

namespace App\Filament\Resources\Jamaah\JamaahKeluargaResource\Pages;

use App\Filament\Resources\Jamaah\JamaahKeluargaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJamaahKeluarga extends CreateRecord
{
    protected static string $resource = JamaahKeluargaResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['id_penanggung_jawab'] = auth()->user()->id;

        return $data;
    }
}
