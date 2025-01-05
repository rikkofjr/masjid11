<?php

namespace App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Zis\ZisPenerimaanResource;
use App\Filament\Widgets\PembayaranZisOverview;
use App\Models\Zis\ZisPenerimaan;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListZisPenerimaans extends ListRecords
{
    use ExposesTableToWidgets ;
    protected static string $resource = ZisPenerimaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getHeaderWidgets():array {
        return [
            PembayaranZisOverview::class,
        ];

    }
    protected function getTableQuery(): ?Builder
    {
        return ZisPenerimaan::where('status_pembayaran', 'PAID');

    }
}
