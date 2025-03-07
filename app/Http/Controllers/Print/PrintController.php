<?php

namespace App\Http\Controllers\Print;

use App\Http\Controllers\Controller;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Zis\PembayaranZis;
use App\Models\Zis\ZisPenerimaan;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\RawbtPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use App\Services\PrinterService;
use Illuminate\Support\Carbon;

class PrintController extends Controller
{

    function wrapText($text, $maxWidth) {
        $words = explode(' ', $text);
        $lines = [];
        $currentLine = '';
    
        foreach ($words as $word) {
            if (strlen($currentLine) + strlen($word) + 1 > $maxWidth) {
                $lines[] = $currentLine;
                $currentLine = '';
            }
            $currentLine .= $word . ' ';
        }
    
        if ($currentLine) {
            $lines[] = $currentLine;
        }
    
        return $lines;
    }

    public function printZisId($id){
        $maxCharsPerLine = 32;
        
        $zisQuery = ZisPenerimaan::where('id', $id)->first();
        $id_jenis_pembayaran_qris = JenisPembayaran::where('short_name', 'qris')->pluck('id')->first();
        $jenis_pembayaran_cash = JenisPembayaran::where('short_name', 'qris')->pluck('id')->first();
        $text_nama_lain = $zisQuery->nama_lain;
        $jenis_zakat = $zisQuery->jenis_zis->nama;
        $nama_amil = $zisQuery->nama_amil->name;
        $removelinebreak_text_nama_lain = preg_replace('/\s+/', ' ', $text_nama_lain);
        $biaya_administrasi_qris = 0.007;
        $hitung_biaya_administrasi = ($zisQuery->uang + $zisQuery->uang_infaq) * $biaya_administrasi_qris;
        $total_yang_dibayar = $zisQuery->uang + $zisQuery->uang_infaq + $hitung_biaya_administrasi;
        //$text_nama_lain = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";


    // Wrap the long text into lines
    $wrappedText = $this->wrapText($removelinebreak_text_nama_lain, $maxCharsPerLine);

    //dd($total_yang_dibayar);
    
        try {
            $date = Carbon::now()->format('Y-m-d H:i:s');
            $printer = new Printer(new RawbtPrintConnector());
            $printer->feed(2);
            $printer->text("Zakat Atas Nama :\n");
            $printer->text("$zisQuery->atas_nama \n ");

            $printer->text("Nama lain : \n");
            foreach ($wrappedText as $line) {
                $printer->text($line . "\n");
            }
            $printer->text("______________________________ \n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Jenis Zakat : \n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("$jenis_zakat \n" );

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Jumlah Jiwa : \n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("$zisQuery->jumlah_jiwa \n" );

            if($zisQuery->beras >= 1 ){
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("Jumlah Beras : \n" );
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text("$zisQuery->beras -Kg \n" );
            }
            if($zisQuery->uang >= 50){
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("Jumlah Uang : \n" );
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text(number_format($zisQuery->uang)."\n" );
                
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("Jumlah Uang Infaq : \n" );
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text(number_format($zisQuery->uang_infaq)."\n" );


                if($zisQuery->id_jenis_pembayaran == $id_jenis_pembayaran_qris){
                    $printer->setJustification(Printer::JUSTIFY_LEFT);
                    $printer->text("Biaya Adminstratif QRIS (0.7%) \n" );
                    $printer->text("Total Keseluruhan: \n" );
                    $printer->setJustification(Printer::JUSTIFY_RIGHT);
                    $printer->text(number_format($total_yang_dibayar)."\n" );
                }
                
            
            }
            
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("______________________________ \n");
            $printer->feed(1);
            $printer->text($date . "\n");
            $printer->text("Amil : " . $nama_amil );
            $printer->text("\n");
            $printer->text("Terimakasih telah melakukan Zakat\n");
            $printer->text("Semoga hari anda diberkahi\n");
            $printer -> cut();
            $printer -> close();


        } 
        catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        }
        return "success";
    }
}
