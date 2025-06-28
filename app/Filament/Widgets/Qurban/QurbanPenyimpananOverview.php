<?php

namespace App\Filament\Widgets\Qurban;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Qurban\QurbanPenyimpanan;
use App\Models\Qurban\QurbanStock;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;


class QurbanPenyimpananOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getCards(): array
    {
        $year = Carbon::now();
        $hijri = Hijri::date('Y', $year);  

         // ambil semua gudang
        $gudangs = QurbanPenyimpanan::all();

        $cards = [];

        foreach ($gudangs as $gudang) {
            // ambil data stock untuk gudang ini di tahun itu
            $stocks = QurbanStock::where('id_qurban_penyimpanan', $gudang->id)
                ->whereYear('hijri', $hijri)
                ->get();

            $totalMasuk = $stocks->where('kuantitas', '>', 0)->sum('kuantitas');
            $totalKeluar = abs($stocks->where('kuantitas', '<', 0)->sum('kuantitas'));
            $sisa = $totalMasuk - $totalKeluar;

            $persentase = $gudang->target_stock ? round(($totalKeluar / $gudang->target_stock) * 100, 2) : 0;

            $cards[] = Card::make($gudang->nama_gudang_penyimpanan, $sisa)
            ->description(
                "Masuk: $totalMasuk | 
                Keluar: $totalKeluar | 
                Target: $gudang->target_stock"
            );

        }

        return $cards;
    }
}


