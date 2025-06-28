<?php

namespace App\Filament\Widgets\Qurban;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages\ListQurbanPenerimaans;
use App\Models\Qurban\QurbanPenerimaan;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QurbanPemotonganOverview extends BaseWidget
{
    protected function getTablePage(): string
    {
        return ListQurbanPenerimaans::class;
    }

    protected function getStats(): array
    {
        $date = Carbon::now();
        $nowHijriYear = Hijri::Date('Y', $date);

        $year = request()->query('filters')['hijri'] ?? $nowHijriYear;
        

        $jumlahKambing = QurbanPenerimaan::where('jenis_hewan', 'kambing')->whereYear('hijri', $year)->count();
        $jumlahKambingSaatIni = QurbanPenerimaan::where('jenis_hewan', 'kambing')->where('status_terakhir', 'diterima')->whereYear('hijri', $year)->count();
        $jumlahKambingDisembelih = QurbanPenerimaan::where('jenis_hewan', 'kambing')->where('status_terakhir', '<>', 'diterima')->whereYear('hijri', $year)->count();
        $jumlahKambingTerkirim = QurbanPenerimaan::where('jenis_hewan', 'kambing')->where('status_terakhir', 'terkirim')->whereYear('hijri', $year)->count();
        
        
        $jumlahSapi = QurbanPenerimaan::where('jenis_hewan', 'sapi')->whereYear('hijri', $year)->count();
        $jumlahSapiSaatIni = QurbanPenerimaan::where('jenis_hewan', 'sapi')->where('status_terakhir', 'diterima')->whereYear('hijri', $year)->count();
        $jumlahSapiDisembelih = QurbanPenerimaan::where('jenis_hewan', 'sapi')->where('status_terakhir', '<>', 'disembelih')->whereYear('hijri', $year)->count();
        $jumlahSapiTerkirim = QurbanPenerimaan::where('jenis_hewan', 'sapi')->where('status_terakhir', 'terkirim')->whereYear('hijri', $year)->count();
        
        $jumlahHewan = QurbanPenerimaan::whereYear('hijri', $year)->count();
        $jumlahHewanDikirim = QurbanPenerimaan::where('status_terakhir', 'terkirim')->whereYear('hijri', $year)->count();
        $persentasePenyelesaian = $jumlahHewan > 0 ? round(($jumlahHewanDikirim / $jumlahHewan) * 100, 2) : 0;
        // Jika ada filter tahun yang dipilih, hitung total berdasarkan tahun tersebut
        // if ($year) {
            
        // } 
        // if($year == $nowHijriYear) {
        //     $jumlahKambing = QurbanPenerimaan::where('jenis_hewan', 'kambing')->whereYear('hijri', $nowHijriYear)->count();
        //     $jumlahSapi = QurbanPenerimaan::where('jenis_hewan', 'sapi')->whereYear('hijri', $nowHijriYear)->count();
        // }

        return [
            Stat::make('Kambing Saat Ini '.$year .'H', $jumlahKambingSaatIni)
            ->description("
                Tersembelih : $jumlahKambingDisembelih | Terikirim : $jumlahKambingTerkirim"
            ),
            
            Stat::make('Sapi Saat Ini '.$year .'H', $jumlahSapiSaatIni)
            ->description("
                Tersembelih : $jumlahSapiDisembelih | Terikirim : $jumlahSapiTerkirim"
            ),
            
            Stat::make('Persentase Penyelesaian '.$year .'H', $persentasePenyelesaian ."%")
            ->description("
                (jumlah hewan yang sudah dikirim ÷ jumlah total hewan) × 100
            "),
        ];
    }
}