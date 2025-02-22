<?php

namespace App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Zis\ZisPenerimaanResource;
use App\Filament\Widgets\PembayaranZisOverview;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Zis\JenisZis;
use App\Models\Zis\ZisPenerimaan;
use Carbon\Carbon;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
class RekapZisHarian extends Page
{
    protected static string $resource = ZisPenerimaanResource::class;
    protected static ?string $model = ZisPenerimaan::class;
    protected static ?string $navigationLabel = 'Rekap Harian Zis';
    protected static ?string $navigationGroup = 'ZIS';
    protected static ?string $title = 'Rekap Harian Zis';
    protected static string $view = 'filament.resources.zis.zis-penerimaan-resource.pages.rekap-zis-harian';
    
    public function getHeaderWidgets():array {
        return [
            PembayaranZisOverview::class,
        ];

    }
    public function getZakatData()
    {
        // Example logic for fetching zakat data, adjust as per your requirement

        $jenisPembayaran = JenisPembayaran::all();
        $jenisZis = JenisZis::all();
        $pembayaranZis = ZisPenerimaan::all();

        return [
            'jenisZis' => $jenisZis,
            'jenisPembayaran' => $jenisPembayaran,
            'pembayaranZis' => $pembayaranZis,
        ];
    }
    public function getZakatDataHarian(){

        $date = Carbon::now();
        $hijriYear = Hijri::date('Y', $date);

        $results = []; // To store the result for each jenisZis
        $jenisZis = JenisZis::all();
        

        foreach ($jenisZis as $jenis) {
            // Query for each jenisZis
            $zisHarian = ZisPenerimaan::select(
                    DB ::raw('DATE(created_at) as date'), 
                    DB::raw('sum(uang) as uang_harian'),
                    DB::raw('sum(uang_infaq) as uang_infaq_harian'),
                    DB::raw('sum(beras) as beras_harian'),
                    DB::raw('sum(beras_infaq) as beras_infaq_harian'),
                    DB::raw('sum(jumlah_jiwa) as jiwa_harian')
                )
                ->groupBy('date')
                ->where('id_jenis_zis', $jenis->id) // Dynamic where condition
                ->where('status_pembayaran', 'PAID') // Dynamic where condition
                ->whereYear('hijri', $hijriYear) // Getting data for the current Hijri year
                ->orderBy('date', 'desc')
                ->get();
            
            // Add the result to the $results array, keyed by jenis ZIS id
            $results[$jenis->id] = $zisHarian;
        }

        return [
            'results' => $results,
            'jenisZis' => $jenisZis  
        ];
    }

}
