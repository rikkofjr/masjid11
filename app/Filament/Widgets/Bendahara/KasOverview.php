<?php

namespace App\Filament\Widgets\Bendahara;

use App\Filament\Resources\Bendahara\TransaksiKasResource\Pages\ListTransaksiKas;
use App\Models\Bendahara\TransaksiKas;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KasOverview extends BaseWidget
{
    use InteractsWithPageTable ;

    protected function getTablePage(): string
    {
        return ListTransaksiKas::class;
    }

    protected function getStats(): array
    {
        $sisaSaldo = TransaksiKas::sum('penerimaan') - TransaksiKas::sum('pengeluaran') ;
        return [
            Stat::make('Sisa Saldo' , number_format($sisaSaldo)),
        ];
    }
}
