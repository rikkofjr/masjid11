<?php

namespace App\Filament\Widgets\Bendahara;

use App\Filament\Resources\Bendahara\TransaksiKasResource\Pages\ListTransaksiKas;
use App\Models\Bendahara\TransaksiKas;
use Carbon\Carbon;
use Flowframe\Trend\TrendValue;
use Flowframe\Trend\Trend;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;

class PenerimaanKasChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penerimaan Tahun Ini';
    protected static string $color = 'success';

    use InteractsWithPageTable;
    
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
        ->sum('penerimaan');
 
        return [
            'datasets' => [
                [
                    'label' => 'Penerimaan Kas',
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
