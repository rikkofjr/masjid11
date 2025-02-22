<?php

namespace App\Livewire\Layanan;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Zis\JenisZis;
use App\Models\Zis\ZisPenerimaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use RealRashid\SweetAlert\Facades\Alert;

class FEPembayaranZis extends Component
{
    use LivewireAlert;

    public $currentStep = 1;
    public $amil, 
        $amil_editor, 
        $id_jenis_zis, 
        $nama_jenis_zis,
        $atas_nama,
        $nama_lain,
        $jumlah_jiwa = 1,
        $uang_zakat,
        $uang_perjiwa,
        $uang,
        $uang_infaq,
        $beras,
        $beras_perjiwa,
        $beras_infaq,
        $jenis_pembayaran,
        $id_jenis_pembayaran,
        $biaya_layanan = 0.0007,
        $hijri,
        $status_pembayaran;

        public $selectedCategoryId;
    

    public function increment()
    {
        $this->jumlah_jiwa++;
    }
    
    public function decrement()
    {
        $this->jumlah_jiwa--;
    } 
        
    public function back($step)
    {
        $this->currentStep = $step;    
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'id_jenis_zis' => 'required',
            'jenis_pembayaran' => 'required'
        ]);
        $this->currentStep = 2;
    }
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'jumlah_jiwa' => 'required',
        ]);
        $this->currentStep = 3;
    }
    
    public function thirdStepSubmit()
    {
        $validatedData = $this->validate([
            'atas_nama' => 'required',
        ]);
        $this->currentStep = 4;
    }

    public function updatedUang($uang_perjiwa, $uang, $uang_infaq)
    {
        // Remove any formatting characters before processing the value
        $this->uang = str_replace(',', '', $uang);
        $this->uang_perjiwa = str_replace(',', '', $uang_perjiwa);
        $this->uang_infaq = str_replace(',', '', $uang_infaq);
        // ... other logic to handle the processed amount
    }

    public function mount(){
       
    }

    public function submitForm()
    {
        $date = Carbon::now();
        $hijri = Hijri::ShortDate($date);
        $convert_uang_zakat = str_replace(",", "", $this->uang_perjiwa);
        if($this->jenis_pembayaran == 'uang'){

            $biaya_layanan = 0.007;

            if(isset($this->uang_infaq)){
                $convert_uang_infaq = str_replace(",", "", $this->uang_infaq);
            }else{
                $convert_uang_infaq = null;
            }
            
            $uang_zakatnnya = $convert_uang_zakat * $this->jumlah_jiwa ;   
                      
            $hitung_biaya_layanan = ($uang_zakatnnya + $convert_uang_infaq) * $biaya_layanan;
            $total_tagihan = ceil($uang_zakatnnya + $convert_uang_infaq + $hitung_biaya_layanan);
            $query_jenis_pembayaran = JenisPembayaran::where('short_name', 'qris')->first();
            $id_jenis_pembayaran = $query_jenis_pembayaran->id ;
            $status_pembayaran = "PENDING";

            $berasnya = null;
        }

        if($this->jenis_pembayaran == 'beras'){
            $uangnya = null;
            $berasnya = $this->beras_perjiwa * $this->jumlah_jiwa;
            $query_jenis_pembayaran = JenisPembayaran::where('short_name', 'beras')->first();
            $id_jenis_pembayaran = $query_jenis_pembayaran->id ;
            $status_pembayaran = "PAID";
        }
        
        $post = ZisPenerimaan::create([
            'amil' => Auth::user()->id,  
            'id_jenis_zis' => $this->id_jenis_zis, 
            'atas_nama' => $this->atas_nama,
            'nama_lain' => $this->nama_lain,
            'jumlah_jiwa' => $this->jumlah_jiwa,
            'uang' => $uang_zakatnnya,
            'uang_infaq' => $convert_uang_infaq,
            'total_tagihan' => $total_tagihan,
            'beras' => $berasnya,
            'beras_infaq' => $this->beras_infaq,
            //'snap_token' => $snapToken,
            'id_jenis_pembayaran' => $id_jenis_pembayaran,
            'status_pembayaran' => $status_pembayaran,
            'hijri' => $hijri,

        ]);
       
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                //'order_id' => rand(),
                'order_id' => $post->id,
                'gross_amount' => $total_tagihan,
            ),
            'customer_details' => array(
                'first_name' => $this->atas_nama,
            )
        );

        try {
            // Mendapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }


        $this->clearform();

        alert()->success('Silahkan Lakukan Pembayaran');
        //Alert::success('Berhasil Menambah ZIS', 'a/n '.$post->atas_nama.'');
        $this->redirect(route('confirm-pembayaran-zis', ['snapToken' => $snapToken, 'id' => $post->id]));

        session()->flash('message', 'User details saved successfully');


       
    }


    public function render()
    {

        $jenis_zis = JenisZis::all();
        $ambil_zakat_fitrah = JenisZis::where('short_name', 'fitrah')->first();
        
        return view('livewire.layanan.f-e-pembayaran-zis', [
            'jenis_zis' => $jenis_zis,
            'ambil_zakat_fitrah' => $ambil_zakat_fitrah,
        ])->layout('components.layouts.layanan');
    }

    public function clearForm()
    {
        
        $this->amil = '';
        $this->amil_editor= ''; 
        $this->id_jenis_zis= ''; 
        $this->atas_nama= '';
        $this->nama_lain= '';
        $this->jumlah_jiwa= '';
        $this->uang= '';
        $this->uang_infaq= '';
        $this->beras= '';
        $this->beras_infaq= '';
        $this->jenis_pembayaran= '';
        $this->id_jenis_pembayaran= '';
        $this->hijri= '';
        $this->status_pembayaran= '';
    }
}
