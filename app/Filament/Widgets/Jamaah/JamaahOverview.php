<?php

namespace App\Filament\Widgets\Jamaah;

use App\Filament\Resources\Jamaah\JamaahKeluargaResource\Pages\ListJamaahKeluargas;
use App\Models\Jamaah\JamaahKeluarga;
use App\Models\Jamaah\JamaahNama;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JamaahOverview extends BaseWidget
{
    use InteractsWithPageTable ;

    protected function getTablePage(): string
    {
        return ListJamaahKeluargas::class;
    }

    protected function getStats(): array
    {

        $totalAnggotaKeluargaCount = $this->getPageTableQuery()->withCount('jamaah_anggota_keluarga')
        ->get()
        ->sum('jamaah_anggota_keluarga_count');
        return [
            Stat::make('Total Jamaah Biasa' , $this->getPageTableQuery()->where('status', 'biasa')->count()),
            Stat::make('Total Jamaah Mustahiq' , $this->getPageTableQuery()->where('status', 'mustahiq')->count()),
            Stat::make('Total Jamaah Donatur' , $this->getPageTableQuery()->where('status', 'donatur')->count()),
            Stat::make('Total Angggota Keluarga' , $totalAnggotaKeluargaCount),
        ];
    }
}
