<?php

namespace App\Filament\Widgets\Bendahara;

use App\Filament\Resources\Bendahara\TransaksiKasResource\Pages\ListTransaksiKas;
use App\Models\Bendahara\TransaksiKas;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\TrendValue;
use Flowframe\Trend\Trend;

class PengeluaranKasChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pengeluaran Tahun Ini';
    protected static string $color = 'danger';



    protected function getTablePage(): string
    {
        return ListTransaksiKas::class;
    }

    protected function getData(): array
    {
        $data = Trend::model(TransaksiKas::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->sum('pengeluaran');
 
        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran Kas',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
