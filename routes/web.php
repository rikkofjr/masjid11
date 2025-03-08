<?php

use App\Http\Controllers\Payment\MidtransPaymentController;
use App\Http\Controllers\Print\PrintController;
use App\Http\Controllers\Zis\ZisController;
use App\Livewire\Auth\LoginPage;
use App\Livewire\HomePage;
use App\Livewire\Layanan\FEPembayaranZisOpener;
use App\Livewire\Layanan\FEPembayaranZis;
use App\Livewire\Layanan\ConfirmPembayaranZis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', LoginPage::class)->name('login');

Route::get('/', HomePage::class);

Route::get('/coba', function(){
    return view('test-page.test-form');
});

Route::get('/print/zis/id/{id}', [PrintController::class, 'printZisId'])->name('print-zis-id');

Route::group(['prefix' => 'print'],function(){
    //Print Zakat {Fitrah, Mall, Fidyah}
    Route::get('/zakat-jamaah/{id}', [ZisController::class, 'printZakatJamaah'])->name('print.zakat.jamaah');
    Route::get('/zakat-tahun/{year}', [ZisController::class,'printZakatTahun'])->name('print.zakat.tahun');
    // //print qurban
    // Route::get('/qurban/{jenis_hewan}', [QurbanController::class, 'printQurbanByThisYear'])->name('print.qurbanRekapJamaah');
    // Route::get('/qurban/jamaah/{id}', [QurbanController::class, 'printQurbanJamaah'])->name('print.qurban.jamaah');

    // //Print Keluarga atau jamaah
    // Route::get('/keluarga/{id}', [AlamatJamaahController::class, 'PrintKeluarga'])->name('print.keluarga');
});


Route::middleware('auth')->group(function() {

    Route::get('/layanan/zis-opener', FEPembayaranZisOpener::class)->name('layanan-pembayaran-zis-opener');
    Route::get('/layanan/zis', FEPembayaranZis::class)->name('layanan-pembayaran-zis');
    Route::get('/layanan/zis/confirm-pembayaran-zis/{id}/{snapToken}', ConfirmPembayaranZis::class)->name('confirm-pembayaran-zis');
    Route::get('/layanan/zis/update-status-pembayaran/{id}/{snapToken}', [MidtransPaymentController::class, 'updatePembayaranZis'])->name('update-pembayaran-zis');


});




