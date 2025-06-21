<?php

namespace App\Filament\Resources\Qurban\QurbanPenyimpananResource\Pages;

use App\Filament\Resources\Qurban\QurbanPenyimpananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQurbanPenyimpanans extends ListRecords
{
    protected static string $resource = QurbanPenyimpananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
