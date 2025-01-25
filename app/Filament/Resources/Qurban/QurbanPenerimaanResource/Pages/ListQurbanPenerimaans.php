<?php

namespace App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource;
use App\Filament\Widgets\Qurban\QurbanPenerimaanOverview;
use App\Models\Qurban\QurbanPenerimaan;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListQurbanPenerimaans extends ListRecords
{
    use ExposesTableToWidgets ;

    protected static string $resource = QurbanPenerimaanResource::class;
    protected static ?string $title = 'Penerimaan Qurban';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets():array {
        return [
            QurbanPenerimaanOverview::class,
        ];

    }

    // protected function getTableQuery(): ?Builder
    // {
    //     $date = Carbon::now();
    //     $nowHijriYear = Hijri::Date('Y', $date);

    //     return QurbanPenerimaan::get();

    // }

    public function getTabs(): array
    {
        return[
            'Kambing' => Tab::make()
                ->query(fn ($query) => $query->where('jenis_hewan', 'kambing')),
            'Sapi' => Tab::make()
                ->query(fn ($query) => $query->where('jenis_hewan', 'sapi')),
        ];
    }
}
