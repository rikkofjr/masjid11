<x-filament-panels::page>
    <style>
        .myButton {
        box-shadow: 0px 10px 14px -7px #276873;
        background:linear-gradient(to bottom, #face69 5%, #d99241 100%);
        background-color:#face69;
        border-radius:8px;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:Arial;
        font-size:20px;
        font-weight:bold;
        padding:13px 32px;
        text-decoration:none;
        text-shadow:0px 1px 0px #3d768a;
    }
    .myButton:hover {
        background:linear-gradient(to bottom, #d99241 5%, #face69 100%);
        background-color:#d99241;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }
    
    </style>
        <button style="color:#000;"
        class="myButton"
        onclick="ajax_print('{{route('print-zis-id', $viewZisPenerimaan->id)}}',this)">
                Print
        </button>
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
            
        </tr>
    </table>
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


</x-filament-panels::page>
