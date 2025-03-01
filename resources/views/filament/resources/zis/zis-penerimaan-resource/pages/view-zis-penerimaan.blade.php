<x-filament-panels::page>
    <table>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%">Atas Nama</td>
            <td>: {{$viewZisPenerimaan->atas_nama}}</td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%">Nama lainnya</td>
            <td>: {{$viewZisPenerimaan->nama_lain}}</td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%">Jenis Zakat</td>
            <td>: {{$viewZisPenerimaan->jenis_zis->nama}}</td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%" valign="top">Jumlah Uang</td>
            <td>
                Uang Zakat : {{$viewZisPenerimaan->uang}}<br/>
                Uang Infaq : {{$viewZisPenerimaan->uang_infaq}}
            </td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%" valign="top">Jumlah Uang</td>
            <td>
                Beras Zakat : {{$viewZisPenerimaan->beras}}<br/>
                Beras Infaq : {{$viewZisPenerimaan->beras_infaq}}
            </td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%">Jenis Pembayaran</td>
            <td>: {{$viewZisPenerimaan->jenis_pembayaran->nama}}</td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%">Amil</td>
            <td>: {{$viewZisPenerimaan->nama_amil->name}}</td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <td width="10%">Tanggal Pembayaran</td>
            <td>: {{$viewZisPenerimaan->created_at}}</td>
        </tr>
        <tr style="border:solid 0.5px #ccc">
            <script src="{{asset('js/vendor/jquery.min.js')}}"></script>
            <script>
                // for php demo call
                function ajax_print(url, btn) {
                    b = $(btn);
                    b.attr('data-old', b.text());
                    b.text('wait');
                    $.get(url, function (data) {
                        window.location.href = data;  // main action
                        function redirectToHomepage() {
                            window.location.href = "{{ route('filament.admin.resources.zis.zis-penerimaans.index') }}";
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

            <button style="color:#000;"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 nextBtn mt-5 pull-right"
            onclick="ajax_print('{{route('print-zis-id', $viewZisPenerimaan->id)}}',this)">
                    Print
            </button>
        </tr>
    </table>

</x-filament-panels::page>
