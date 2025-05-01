<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>LDC SHOLAT CUY</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    html, body {
      height: 100%;
      margin: 0;
      overflow: hidden;
    }
    .jadwal-item {
      flex: 1;
      text-align: center;
	  padding-top:60px;
	  padding-bottom:40px;
      color: white;
    }
	.judul{
		
	}
	.nama_waktu{
		text-align:Center;
	}
	.jam{
		margin-top:10px;
	}
  </style>
</head>
<body class="relative text-white">

  <!-- Background Slideshow -->
  {{ asset('storage/'.$photoDisplayFirst->photo_display[0]) }}
  <img id="slide" src="" class="absolute inset-0 w-full h-full object-cover" />

  <!-- Header Atas -->
  <div class="absolute top-0 left-0 w-full flex items-center justify-between bg-black bg-opacity-70 p-4 text-white">
    <div id="tanggal" class="text-2xl"></div>
    <div class="text-center flex-1">
      <h1 class="text-4xl font-extrabold">{{$profileMasjid->nama_masjid}}</h1>
      <p class="text-lg">{{$profileMasjid->nama_masjid}}</p>
    </div>
    <div id="jam" class="text-4xl font-bold"></div>
  </div>

  <!-- Kegiatan Masjid -->
  <div class="absolute bottom-44 left-0 w-full bg-black bg-opacity-60 p-3 text-center text-2xl">
    <marquee behavior="scroll" direction="left">
      Kajian Rutin Sabtu Pagi - Sabtu 09/12/2023 | Kajian AA Gym - Senin 18/12/2023 | Kajian Syafiq Basalamah - Senin 25/12/2023
    </marquee>
  </div>

  <!-- Jadwal Salat -->
  <div class="absolute bottom-0 left-0 w-full flex text-5xl font-bold" id="jadwalSholat">
    <div class="jadwal-item" style="background-color: rgba(229,57,53,0.6);">
		<div class="w-full" style="margin-top:-60px;padding-bottom:10px;width:100%;background-color: rgba(229,57,53,0.6);">
			<p class="nama_waktu">Subuh</p>
		</div>
		<p class="jam" id="subuh">-</p>
    </div>
	<div class="jadwal-item" style="background-color: rgba(41,182,246,0.6);">
		<div class="w-full" style="margin-top:-60px;padding-bottom:10px;width:100%;background-color: rgba(41,182,246,0.6);">
			<p class="nama_waktu">Terbit</p>
		</div>
		<p class="jam" id="terbit">-</p>
    </div>
	<div class="jadwal-item" style="background-color: rgba(255,165,0,0.6);">
		<div class="w-full" style="margin-top:-60px;padding-bottom:10px;width:100%;background-color: rgba(255,165,0,0.6);">
			<p class="nama_waktu">Dzuhur</p>
		</div>
		<p class="jam" id="dzuhur">-</p>
    </div>
	<div class="jadwal-item" style="background-color: rgba(238,130,246,0.6);">
		<div class="w-full" style="margin-top:-60px;padding-bottom:10px;width:100%;background-color: rgba(238,130,246,0.6);">
			<p class="nama_waktu">Ashar</p>
		</div>
		<p class="jam" id="ashar">-</p>
    </div>
	<div class="jadwal-item" style="background-color: rgba(41,182,246,0.6);">
		<div class="w-full" style="margin-top:-60px;padding-bottom:10px;width:100%;background-color: rgba(41,182,246,0.6);">
			<p class="nama_waktu">Magrhib</p>
		</div>
		<p class="jam" id="maghrib">-</p>
    </div>
	<div class="jadwal-item" style="background-color: rgba(216,27,96,0.6);">
		<div class="w-full" style="margin-top:-60px;padding-bottom:10px;width:100%;background-color: rgba(216,27,96,0.6);">
			<p class="nama_waktu">Isha</p>
		</div>
		<p class="jam" id="isya">-</p>
    </div>
  </div>

  <!-- JS Jam, Tanggal, Slideshow, API & Auto Refresh -->
  <script>
    function updateDateTime() {
      const now = new Date();
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      document.getElementById("tanggal").innerHTML = now.toLocaleDateString("id-ID", options);
      document.getElementById("jam").innerHTML = now.toLocaleTimeString("id-ID", { hour12: false });
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();

    // Slideshow
    const photos = [
      @foreach($photoDisplay as $item)
        "{{ asset('storage/'.$item->photo_display) }}",
      @endforeach
    ];


    let index = 0;
    setInterval(() => {
      index = (index + 1) % photos.length;
      document.getElementById("slide").src = photos[index];
    }, 5000);

    // Fetch Jadwal Sholat via Aladhan API
    function fetchJadwalSholat() {
      fetch("https://api.aladhan.com/v1/timingsByCity?city=Jakarta&country=Indonesia&method=11")
        .then(response => response.json())
        .then(data => {
          const jadwal = data.data.timings;
          document.getElementById("subuh").innerText = jadwal.Fajr;
          document.getElementById("terbit").innerText = jadwal.Sunrise;
          document.getElementById("dzuhur").innerText = jadwal.Dhuhr;
          document.getElementById("ashar").innerText = jadwal.Asr;
          document.getElementById("maghrib").innerText = jadwal.Maghrib;
          document.getElementById("isya").innerText = jadwal.Isha;
        })
        .catch(error => console.error("Gagal ambil jadwal sholat:", error));
    }
    fetchJadwalSholat();
    setInterval(fetchJadwalSholat, 60000 * 60); // Update tiap 1 jam

    // Auto Refresh Jam 00:01
    function autoRefreshAtMidnight() {
      const now = new Date();
      const nextMidnight = new Date();
      nextMidnight.setHours(24, 0, 1, 0);
      const timeout = nextMidnight.getTime() - now.getTime();
      console.log("Refresh otomatis dalam " + Math.floor(timeout/1000/60) + " menit.");
      setTimeout(() => location.reload(), timeout);
    }
    autoRefreshAtMidnight();
  </script>

</body>
</html>
