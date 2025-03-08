<?php

namespace App\Http\Controllers\Zis;

use App\Http\Controllers\Controller;
use App\Models\Zis\ZisPenerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZisController extends Controller
{
    public function printZakatTahun($year){
        $zis = ZisPenerimaan::with('jenis_zis')
        ->where('status_pembayaran', 'PAID')
        ->whereYear('hijri',$year)
        ->orderBy('created_at','ASC')
        ->get(); 

        $zisYear = ZisPenerimaan::with('jenis_zis')
        ->select(
            DB::raw('YEAR(hijri) as thisYear'), 
            DB::raw('id_jenis_zis'), 
            DB::raw('sum(uang) as uang_tahunan'), 
            DB::raw('sum(uang_infaq) as uang_infaq_tahunan'),
            DB::raw('sum(beras) as beras_tahunan'),
            DB::raw('sum(beras_infaq) as beras_infaq_tahunan'),
            DB::raw('sum(jumlah_jiwa) as jiwa_tahunan'),
            DB::raw('count(id_jenis_zis) as jumlah_data')
        )
        ->groupBy('thisYear', 'id_jenis_zis')
        ->where('status_pembayaran','PAID')
        ->whereYear('hijri', $year)//getting daily data from hijriah year
        ->get();

        if($zis->isEmpty()){
            abort('404');
        }else{
            // $pdf = PDF::loadView('dashboard.zis.print.print-tahun', compact('zis', 'year' ,'zisYear'));
            // $namaFile = 'Zakat Tahun' . $year;
            // $pdf->setPaper('A4', 'landscape');
            // return $pdf->stream(''.$namaFile.'.pdf');
            return view('filament.resources.zis.zis-penerimaan-resource.pages.print-tahun', compact('zis', 'year' ,'zisYear'));
        }
        // return view('dashboard.zis.print.print-tahun', compact('zis', 'year' ,'zisYear'));


    }
}
