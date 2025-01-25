<?php

namespace App\Filament\Resources\Jamaah\JamaahKeluargaResource\Pages;

use App\Filament\Resources\Jamaah\JamaahKeluargaResource;
use App\Filament\Widgets\Jamaah\JamaahOverview;
use App\Models\Jamaah\JamaahKeluarga;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListJamaahKeluargas extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = JamaahKeluargaResource::class;
    protected static ?string $title = 'Keluarga Jamaah';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets():array{
        return [
            JamaahOverview::class,
        ];
    }

    public function getTabs(): array
    {
        return[
            'Jamaah Internal' => Tab ::make()
                ->query(fn ($query) => $query->where('tipe', 'internal')),
            'Jamaah External' => Tab::make()
                ->query(fn ($query) => $query->where('tipe', 'external')),
        ];
    }
    // protected function getTableQuery(): ?Builder
    // {
    //     //return JamaahKeluarga::all();

    // }
    
}
