<?php

namespace App\Filament\Widgets;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Zis\ZisPenerimaanResource\Pages\ListZisPenerimaans;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PembayaranZisOverview extends BaseWidget
{
    use InteractsWithPageTable ;


    protected function getTablePage(): string
    {
        return ListZisPenerimaans::class;
    }

    protected function getStats(): array
    {
        $date = Carbon::now();
        $hijriDate = Hijri::date('Y', $date);

        return [
            Stat::make('Total Transaksi', $this->getPageTableQuery()->count()),
            Stat::make('Uang Zakat', number_format($this->getPageTableQuery()->sum('uang'))),
            Stat::make('Uang Infaq', number_format($this->getPageTableQuery()->sum('uang_infaq'))),
            Stat::make('Beras', number_format($this->getPageTableQuery()->sum('beras'), 2)),
            Stat::make('beras Infaq', number_format($this->getPageTableQuery()->sum('beras_infaq'))),
        ];
    }
}
