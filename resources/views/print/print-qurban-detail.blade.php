<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Nota Hewan qurban</title>
  <script>
  window.onload = function() {
    window.print();
  }
</script>

  <style>
    @page {
      size: A5 landscape;
      margin: 5mm;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      font-size: 11px;
    }
    .nota {
      width: 100%;
      height: 100%;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .header {
      text-align: center;
      margin-bottom: 3mm;
    }
    .header h2 {
      margin: 0;
      font-size: 16px;
    }
    .header p {
      margin: 2px 0 0;
      font-size: 12px;
    }
    .content {
      display: flex;
      justify-content: space-between;
      gap: 5mm;
      flex-grow: 1;
    }
    .left, .right {
      width: 50%;
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
    }
    .data-table td {
      padding: 1.5mm 0;
      vertical-align: top;
      font-size: 11px;
    }
    .data-table td.label {
      width: 40%;
      font-weight: bold;
    }
    .photo {
      text-align: center;
      margin-top: 3mm;
    }
    .photo img {
      max-width: 50mm;
      max-height: 40mm;
      border: 1px solid #000;
      object-fit: contain;
    }
    .footer {
      text-align: center;
      font-size: 10px;
      margin-top: 2mm;
    }
  </style>
</head>
<body>
  <img src="{{ $profileMasjid->logo ? asset('storage/' . $profileMasjid->logo) : asset('img/logo.png') }}" 
     alt="Watermark" 
     style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 60%; opacity: 0.04; z-index: -1;">

  <div class="nota">
    <div class="header">
      <div class="header-title">
        <h2>Nota Pendataan Hewan Qurban</h2>
        <p>Panitia Idul Adha {{ explode('-', $data->hijri)[0] }}</p>
      </div>
      <div class="header-logo" style="margin-top:-6px; position: absolute; top: 5px; right: 10px;">
        <img src="{{ $profileMasjid->logo ? asset('storage/' . $profileMasjid->logo) : asset('img/logo.png') }}" alt="Logo" height="50px">
      </div>
    </div>

    <div class="content" style="">
      <div class="left">
        <table class="data-table">
          <tr>
            <td class="label">Nomor Hewan</td>
            <td>: {{$data->nomor_hewan}}</td>
          </tr>
          <tr>
            <td class="label">Jenis Hewan</td>
            <td>: {{$data->jenis_hewan}}</td>
          </tr>
          <tr>
            <td class="label">Atas Nama</td>
            <td>: {{$data->atas_nama}}</td>
          </tr>
          <tr>
            <td class="label">Alamat</td>
            <td>: {{$data->alamat}}</td>
          </tr>
          <tr>
            <td class="label">Nama Lain</td>
            <td>{!! nl2br(e($data->nama_lain)) !!}</td>
          </tr>
        </table>
      </div>

      <div class="right">
        <table class="data-table">
          <tr>
            <td class="label">Permintaan</td>
            <td>{!! nl2br(e($data->permintaan)) !!}</td>
          </tr>
          <tr>
            <td class="label">No. HP</td>
            <td>: {{$data->nomor_handphone}}</td>
          </tr>
          <tr>
            <td class="label">Disaksikan</td>
            <td>: {{ $data->disaksikan ? '✔️' : 'x' }}</td>
          </tr>
          <tr>
            <td class="label">Keterangan</td>
            <td>: {!! nl2br(e($data->keterngan)) !!}</td>
          </tr>
          <tr>
            <td class="label">Panitia</td>
            <td>: {{$data->nama_amil->name}}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="photo" style="display: flex; justify-content: center; align-items: center; gap: 5mm; margin-top: 3mm;">
      <div>
        <img src="{{ asset('storage/' . $data->photo_hewan) }}" alt="Foto Hewan" style="max-width: 50mm; max-height: 40mm; border: 1px solid #000; object-fit: contain;">
      </div>
      <div>
        {!! QrCode::size(120)->generate(url('/print/qurban/detail/'.$data->id)) !!}
      </div>
      Harap disimpan dengan baik tanda bukti ini  <br>
      {{$data->created_at}}
    </div>

    <div class="footer">
      
    </div>
  </div>
</body>
</html>
