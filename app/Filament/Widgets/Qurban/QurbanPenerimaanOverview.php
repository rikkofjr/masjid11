<?php

namespace App\Filament\Widgets\Qurban;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages\ListQurbanPenerimaans;
use App\Models\Qurban\QurbanPenerimaan;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QurbanPenerimaanOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListQurbanPenerimaans::class;
    }

    protected function getStats(): array
    {
        $date = Carbon::now();
        $nowHijriYear = Hijri::Date('Y', $date);

        $year = request()->query('filters')['hijri'] ?? $nowHijriYear;
        

        $jumlahKambing = QurbanPenerimaan::where('jenis_hewan', 'kambing')->where('status_terakhir', 'diterima')->whereYear('hijri', $year)->count();
        $jumlahSapi = QurbanPenerimaan::where('jenis_hewan', 'sapi')->where('status_terakhir', 'diterima')->whereYear('hijri', $year)->count();
        // Jika ada filter tahun yang dipilih, hitung total berdasarkan tahun tersebut
        // if ($year) {
            
        // } 
        // if($year == $nowHijriYear) {
        //     $jumlahKambing = QurbanPenerimaan::where('jenis_hewan', 'kambing')->whereYear('hijri', $nowHijriYear)->count();
        //     $jumlahSapi = QurbanPenerimaan::where('jenis_hewan', 'sapi')->whereYear('hijri', $nowHijriYear)->count();
        // }

        return [
            Stat::make('Total Kambing '.$year .'H', $jumlahKambing),
            Stat::make('Total Sapi '.$year .'H', $jumlahSapi),
        ];
    }
}
