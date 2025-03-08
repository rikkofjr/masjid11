<div>
    <div class="container w-full h-screen p-12">
        <div class="container drop-shadow-xl py-10 px-5 min-h-80 items-center">
            <div class="bg-white px-5 py-5">
                <h2 class="font-semibold text-gray-700 text-xl md:text-3xl mb-5">
                    Hallo {{$id->atas_nama}}, ini adalah rincian ZIS Anda
                </h2>
            <br/>
        
            <table border="1" class="table-auto">
                <tbody>
                    <tr>
                        <td>Zakat Atas Nama</td>
                        <td>: {{$id->atas_nama}}</td>
                    </tr>
                    <tr>
                        <td valign="top">Nama Lain</td>
                        <td>: {!! nl2br(e( $id->nama_lain)) !!}</td>
                    </tr>
                    <tr>
                        <td>Jenis ZIS</td>
                        <td>: {{$id->jenis_zis->nama}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Jiwa</td>
                        <td>: {{$id->jumlah_jiwa}}</td>
                    </tr>
                    <tr>
                        <td>Nominal Zakat</td>
                        <td>: {{number_format($id->uang)}} {{$id->beras}} </td>
                    </tr>
                    <tr>
                        <td>Nominal Infaq</td>
                        <td>: {{number_format($id->uang_infaq)}} {{$id->beras_infaq}} </td>
                    </tr>
                    <tr>
                        <td>Jenis Pembayaran</td>
                        <td>: {{$id->jenis_pembayaran->nama}} </td>
                    </tr>
                    <tr>
                        <td>Biaya adminsitratif</td>
                        <td>: {{$id->jenis_pembayaran->nama}} </td>
                    </tr>
                    @if($id->status_pembayaran == "PENDING")
                    <tr>
                        <td>Total Tagihan</td>
                        <td>: {{number_format($id->total_tagihan)}} </td>
                    </tr>
                    @endif
                </tbody>
            </table>
    
                        <br/>
            

            <br/>
            @if($id->status_pembayaran == "PENDING")

            <a href="{{route('layanan-pembayaran-zis-opener')}}"
                class="focus:outline-none text-white bg-gray-200 hover:bg-red-300 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 nextBtn mt-5 pull-right"    
                type="button">
                    Batal
                </a>
                
                <button 
                class="focus:outline-none text-white bg-red-700 hover:bg-red-300 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 nextBtn mt-5 pull-right"    
                id="pay-button"" type="button">
                    Lakukan Pembayaran
                </button>
                <!-- https://app.sandbox.midtrans.com/snap/snap.js -->
                <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
                    <script type="text/javascript">
                      document.getElementById('pay-button').onclick = function(){
                        // SnapToken acquired from previous step
                        snap.pay('{{ $snapToken }}', {
                          // Optional
                          onSuccess: function(result){
                            /* You may add your own js here, this is just example */ 
                            window.location.href = "{{ route('update-pembayaran-zis', ['id' => $id, 'snapToken' => $snapToken]) }}" ;
                        
                          },
                          // Optional
                          onPending: function(result){
                            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                          },
                          // Optional
                          onError: function(result){
                            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                          }
                        });
                      };
                    </script>

            @endif
            </div>
            <div class="bg-white m-0 text-center">
                @if($id->status_pembayaran == "PAID")
            
                <script>
                    // for php demo call
                    function ajax_print(url, btn) {
                        b = $(btn);
                        b.attr('data-old', b.text());
                        b.text('wait');
                        $.get(url, function (data) {
                            window.location.href = data;  // main action
                            function redirectToHomepage() {
                                window.location.href = "{{ route('layanan-pembayaran-zis-opener') }}";
                            }
                            // Trigger the redirection after a certain delay or event
                            setTimeout(redirectToHomepage, 1500); // Redirect after 5 seconds
                        }).fail(function () {
                            alert("ajax error");
                        }).always(function () {
                            b.text(b.attr('data-old'));
                        })
                    }                
                </script>

                <p class="font-semibold text-gray-700 text-sm md:text-2xl mb-1 m-auto">
                    Terimakasih, pembayaran telah berhasil silahkan klik tombol 
                    "Keluar" dan ambil bukti pembayaran anda
                </p>
                <button 
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 nextBtn mt-5 pull-right"
                onclick="ajax_print('{{route('print-zis-id', $id->id)}}',this)">
                        Keluar
                </button>
            @endif
            </div>
        </div>
    </div>
</div>

