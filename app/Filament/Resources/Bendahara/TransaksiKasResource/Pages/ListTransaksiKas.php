<?php

namespace App\Filament\Resources\Bendahara\TransaksiKasResource\Pages;

use App\Filament\Resources\Bendahara\TransaksiKasResource;
use App\Filament\Widgets\Bendahara\KasFilter;
use App\Filament\Widgets\Bendahara\KasOverview;
use App\Filament\Widgets\Bendahara\PenerimaanKasChart;
use App\Filament\Widgets\Bendahara\PengeluaranKasChart;
use App\Models\Bendahara\TransaksiKas;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListTransaksiKas extends ListRecords
{
    protected static string $resource = TransaksiKasResource::class;

    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return[
            KasOverview::class,
            PenerimaanKasChart::class,
            PengeluaranKasChart::class,
        ];

        
    }
    protected function getTableQuery(): ?Builder
    {
        return TransaksiKas::orderBy('created_at', 'desc');

    }
}
