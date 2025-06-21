<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Nota Hewan Qurban</title>
  <script>
    window.onload = function() {
      window.print();
    }
  </script>

  <style>
    @page {
      size: A4 portrait;
      margin: 5mm;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      font-size: 11px;
    }
    .container {
      display: flex;
      flex-direction: column;
      gap: 5mm;
    }
    .nota {
      width: 100%;
      height: 135mm;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      page-break-inside: avoid;
      position: relative;
      border: 1px dashed #ccc;
      padding: 5mm;
      overflow: hidden;
    }
    .header {
      text-align: center;
      margin-bottom: 3mm;
      position: relative;
    }
    .header h2 {
      margin: 0;
      font-size: 16px;
    }
    .header p {
      margin: 2px 0 0;
      font-size: 12px;
    }
    .header-logo {
      position: absolute;
      top: 0;
      right: 5mm;
    }
    .header-logo img {
      height: 40px;
    }
    .content {
      display: flex;
      justify-content: space-between;
      gap: 5mm;
      flex-grow: 1;
      overflow: hidden;
    }
    .left, .right {
      width: 50%;
      overflow: hidden;
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }
    .data-table td {
      padding: 1.5mm 0;
      vertical-align: top;
      font-size: 11px;
      word-wrap: break-word;
    }
    .data-table td.label {
      width: 40%;
      font-weight: bold;
      vertical-align: top;
    }
    .photo {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5mm;
      margin-top: 3mm;
    }
    .photo img {
      max-width: 45mm;
      max-height: 35mm;
      border: 1px solid #000;
      object-fit: contain;
    }
    .footer {
      text-align: center;
      font-size: 10px;
      margin-top: 2mm;
    }
    .watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60%;
      opacity: 0.04;
      z-index: -1;
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- Nota 1 -->
    <div class="nota">
      <img class="watermark" src="{{ asset('img/logo.png') }}" alt="Watermark">
      <div class="header">
        <h2>Nota Pendataan Hewan Qurban</h2>
        <p>Panitia Idul Adha 1446</p>
        <div class="header-logo">
          <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </div>
      </div>
      <div class="content">
        <div class="left">
           <table class="data-table">
            <tr><td class="label">Nomor Hewan</td><td>: {{$data->nomor_hewan}}</td></tr>
            <tr><td class="label">Jenis Hewan</td><td>: {{$data->jenis_hewan}}</td></tr>
            <tr><td class="label">Atas Nama</td><td>: {{$data->atas_nama}}</td></tr>
            <tr><td class="label">Alamat</td><td>: {{$data->alamat}}</td></tr>
            <tr><td class="label">Nama Lain</td><td>{!! nl2br(e($data->nama_lain)) !!}</td></tr>
          </table>
        </div>
        <div class="right">
          <table class="data-table">
            <tr><td class="label">No. HP</td><td>: {{$data->nomor_handphone}}</td></tr>
            <tr><td class="label">Disaksikan</td><td>: {{ $data->disaksikan ? '✔️' : 'x' }}</td></tr>
            <tr><td class="label">Keterangan</td><td>: {!! nl2br(e($data->keterngan)) !!}</td></tr>
            <tr><td class="label">Panitia</td><td>: {{$data->nama_amil->name}}</td></tr>
            <tr><td class="label">Permintaan</td><td>{!! nl2br(e($data->permintaan)) !!}</td></tr>
          </table>
        </div>
      </div>
      <div class="photo">
        <div>
          <img src="{{ asset('storage/' . $data->photo_hewan) }}" alt="Foto Hewan">
        </div>
        <div>
          {!! QrCode::size(100)->generate(url('/print/qurban/detail/4')) !!}
        </div>
      </div>
      <div class="footer">
        Harap disimpan dengan baik tanda bukti ini<br>2025-06-08 17:59:48
      </div>
    </div>

    <!-- Nota 2 -->
    <div class="nota">
      <img class="watermark" src="{{ asset('img/logo.png') }}" alt="Watermark">
      <div class="header">
        <h2>Nota Pendataan Hewan Qurban</h2>
        <p>Panitia Idul Adha 1446</p>
        <div class="header-logo">
          <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </div>
      </div>
      <div class="content">
        <div class="left">
          <table class="data-table">
            <tr><td class="label">Nomor Hewan</td><td>: {{$data->nomor_hewan}}</td></tr>
            <tr><td class="label">Jenis Hewan</td><td>: {{$data->jenis_hewan}}</td></tr>
            <tr><td class="label">Atas Nama</td><td>: {{$data->atas_nama}}</td></tr>
            <tr><td class="label">Alamat</td><td>: {{$data->alamat}}</td></tr>
            <tr><td class="label">Nama Lain</td><td>{!! nl2br(e($data->nama_lain)) !!}</td></tr>
          </table>
        </div>
        <div class="right">
          <table class="data-table">
            <tr><td class="label">No. HP</td><td>: {{$data->nomor_handphone}}</td></tr>
            <tr><td class="label">Disaksikan</td><td>: {{ $data->disaksikan ? '✔️' : 'x' }}</td></tr>
            <tr><td class="label">Keterangan</td><td>: {!! nl2br(e($data->keterngan)) !!}</td></tr>
            <tr><td class="label">Panitia</td><td>: {{$data->nama_amil->name}}</td></tr>
            <tr><td class="label">Permintaan</td><td>{!! nl2br(e($data->permintaan)) !!}</td></tr>
          </table>
        </div>
      </div>
      <div class="photo">
        <div>
          <img src="{{ asset('storage/' . $data->photo_hewan) }}" alt="Foto Hewan">
        </div>
        <div>
          {!! QrCode::size(100)->generate(url('/print/qurban/detail/4')) !!}
        </div>
      </div>
      <div class="footer">
        Harap disimpan dengan baik tanda bukti ini<br>2025-06-08 18:01:30
      </div>
    </div>

  </div>
</body>
</html>
