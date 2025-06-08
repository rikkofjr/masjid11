<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Display - Pondok Indah Mall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pastikan elemen root mengambil tinggi penuh viewport dan tidak ada scrolling */
        html, body {
            height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            overflow: hidden;
            box-sizing: border-box; /* Padding dan border termasuk dalam lebar/tinggi elemen */
        }

        body {
            /* --- PERUBAHAN BACKGROUND HALAMAN DISINI --- */
            background-color: #fff; /* Warna putih sebagai base */
            background-image: url('{{asset('/img/pattern.png')}}'); /* Gambar pattern */
            background-repeat: repeat; /* Ulangi pattern */
            background-size: auto; /* Ukuran asli pattern */
            /* --- AKHIR PERUBAHAN BACKGROUND HALAMAN --- */

            color: #e2e8f0; /* Light text color */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column; /* Tata letak vertikal: header, main content, footer */
        }

        /* Warna baru untuk header dan footer */
        .header, .footer {
            background-color: #14746f; /* Warna hijau gelap baru */
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.4rem;
            font-weight: bold;
            flex-shrink: 0; /* Mencegah header/footer mengecil */
            min-height: 50px; /* Tinggi minimum agar tidak terlalu kecil */
        }

        /* Styling tambahan untuk grup tanggal dan logo di header */
        .header-left {
            display: flex;
            align-items: center;
        }

        /* Konten utama (prayer times dan video) */
        .main-content {
            display: flex; /* Mengatur layout horizontal untuk prayer times dan video */
            flex-grow: 1; /* Mengambil sisa ruang vertikal yang tersedia */
            overflow: hidden;
        }

        /* PERUBAHAN KOLOM WAKTU SHOLAT */
        .prayer-times {
            width: 30%; /* Mengambil 30% lebar dari main-content */
            flex-shrink: 0; /* Mencegah kolom ini mengecil */
            border-radius: 0;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }

        /* Warna spesifik untuk setiap waktu sholat */
        .bg-subuh { background-color: #358f80; }
        .bg-terbit { background-color: #469d89; }
        .bg-dzuhur { background-color: #56ab91; }
        .bg-ashar { background-color: #67b99a; }
        .bg-maghrib { background-color: #78c6a3; }
        .bg-isha { background-color: #88d4ab; }

        .prayer-item {
            padding: 0.6rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.6rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-grow: 1;
        }
        .prayer-item:last-child {
            border-bottom: none;
        }
        /* Efek untuk waktu sholat yang sedang aktif */
        .prayer-item.active {
            filter: brightness(0.85);
            font-weight: bold;
        }

        /* --- PERUBAHAN UNTUK VIDEO CONTAINER DISINI --- */
        .video-container {
            flex-grow: 1; /* Ini akan mengambil sisa 70% lebar yang tersedia */
            background-color: transparent; /* Latar belakang menjadi transparan */
            /* Hapus border-radius agar tidak ada sudut membulat */
            border-radius: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-left: 1rem; /* Jarak antara kolom sholat dan video tetap ada */
            padding: 0; /* Hapus padding agar video bisa benar-benar full */
            height: 100%;
            min-height: 0;
            position: relative;
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Video akan mengisi seluruh area container, mungkin ada pemotongan tepi */
        }
        /* --- AKHIR PERUBAHAN VIDEO CONTAINER --- */

        .running-text-wrapper {
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }
        .running-text {
            display: inline-block;
            font-size: 1.2rem;
            animation: marquee 60s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-left">
            <img src="{{ $profileMasjid->logo ? asset('storage/' . $profileMasjid->logo) : asset('img/logo.png') }}"
                 alt="Logo Masjid"
                 class="h-12 mr-4 cursor-pointer"
                 id="fullscreenLogo">
            <div>
                <div id="currentDate"></div>
                <div id="currentHijriDate" class="text-sm"></div>
            </div>
        </div>
        <div class="text-2xl">{{$profileMasjid->nama_masjid}}</div>
        <div id="currentTime"></div>
    </header>

    <main class="main-content">
        <section class="prayer-times" id="prayerTimes">
            <div class="prayer-item bg-subuh">
                <span>Subuh</span>
                <span id="subuhTime">Memuat...</span>
            </div>
            <div class="prayer-item bg-terbit">
                <span>Terbit</span>
                <span id="terbitTime">Memuat...</span>
            </div>
            <div class="prayer-item bg-dzuhur">
                <span>Dzuhur</span>
                <span id="dzuhurTime">Memuat...</span>
            </div>
            <div class="prayer-item bg-ashar">
                <span>Ashar</span>
                <span id="asharTime">Memuat...</span>
            </div>
            <div class="prayer-item bg-maghrib">
                <span>Maghrib</span>
                <span id="maghribTime">Memuat...</span>
            </div>
            <div class="prayer-item bg-isha">
                <span>Isya</span>
                <span id="isyaTime">Memuat...</span>
            </div>
        </section>

        <section class="video-container">
            <video id="displayVideo" autoplay muted controlsList="nodownload nofullscreen noremoteplayback" disablePictureInPicture></video>
        </section>
    </main>

    <footer class="footer">
        <div class="running-text-wrapper">
            <div class="running-text" id="runningText">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
        </div>
    </footer>

    <script>
        // --- Header: Date and Time ---
        function updateDateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };

            // Format tanggal Gregorian dan ganti 'Minggu' menjadi 'Ahad'
            let formattedDate = now.toLocaleDateString('id-ID', optionsDate);
            formattedDate = formattedDate.replace('Minggu', 'Ahad');
            document.getElementById('currentDate').textContent = formattedDate;

            // --- PENAMBAHAN TANGGAL HIJRIAH DISINI ---
            const optionsHijri = { calendar: 'islamic-umalqura', day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('currentHijriDate').textContent = now.toLocaleDateString('id-ID', optionsHijri);
            // --- AKHIR PENAMBAHAN TANGGAL HIJRIAH ---

            document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID', optionsTime) + ' WIB';
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();

        // --- Prayer Times API ---
        window.lastTimings = {};

        async function fetchPrayerTimesAndStore() {
            const city = 'Jakarta';
            const country = 'Indonesia';
            const method = 11;
            const url = `https://api.aladhan.com/v1/timingsByCity?city=${city}&country=${country}&method=${method}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.status === 'OK') {
                    window.lastTimings = data.data.timings;
                    document.getElementById('subuhTime').textContent = window.lastTimings.Fajr;
                    document.getElementById('terbitTime').textContent = window.lastTimings.Sunrise;
                    document.getElementById('dzuhurTime').textContent = window.lastTimings.Dhuhr;
                    document.getElementById('asharTime').textContent = window.lastTimings.Asr;
                    document.getElementById('maghribTime').textContent = window.lastTimings.Maghrib;
                    document.getElementById('isyaTime').textContent = window.lastTimings.Isha;

                    highlightCurrentPrayer(window.lastTimings);
                } else {
                    console.error('Failed to fetch prayer times:', data.data.message);
                    document.querySelectorAll('#prayerTimes span').forEach(el => el.textContent = 'Gagal memuat');
                }
            } catch (error) {
                console.error('Error fetching prayer times:', error);
                document.querySelectorAll('#prayerTimes span').forEach(el => el.textContent = 'Gagal memuat');
            }
        }

        function highlightCurrentPrayer(timings) {
            if (!timings) return;

            const now = new Date();
            const currentHours = now.getHours();
            const currentMinutes = now.getMinutes();
            const currentTimeInMinutes = currentHours * 60 + currentMinutes;

            const prayerOrder = ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
            const prayerElements = {
                Fajr: document.getElementById('subuhTime').closest('.prayer-item'),
                Sunrise: document.getElementById('terbitTime').closest('.prayer-item'),
                Dhuhr: document.getElementById('dzuhurTime').closest('.prayer-item'),
                Asr: document.getElementById('asharTime').closest('.prayer-item'),
                Maghrib: document.getElementById('maghribTime').closest('.prayer-item'),
                Isha: document.getElementById('isyaTime').closest('.prayer-item')
            };

            Object.values(prayerElements).forEach(el => el.classList.remove('active'));

            let activePrayerFound = false;

            for (let i = 0; i < prayerOrder.length; i++) {
                const prayerName = prayerOrder[i];
                const prayerTimeStr = timings[prayerName];
                if (!prayerTimeStr) continue;

                const [prayerHour, prayerMinute] = prayerTimeStr.split(':').map(Number);
                const prayerTimeInMinutes = prayerHour * 60 + prayerMinute;

                let nextPrayerTimeInMinutes = Infinity;
                if (i + 1 < prayerOrder.length) {
                    const nextPrayerName = prayerOrder[i + 1];
                    const nextPrayerTimeStr = timings[nextPrayerName];
                    if (nextPrayerTimeStr) {
                        const [nextPrayerHour, nextPrayerMinute] = nextPrayerTimeStr.split(':').map(Number);
                        nextPrayerTimeInMinutes = nextPrayerHour * 60 + nextPrayerMinute;
                    }
                }

                if (currentTimeInMinutes >= prayerTimeInMinutes && currentTimeInMinutes < nextPrayerTimeInMinutes) {
                    prayerElements[prayerName].classList.add('active');
                    activePrayerFound = true;
                    break;
                }
            }

            if (!activePrayerFound) {
                const fajrTimeStr = timings.Fajr;
                const ishaTimeStr = timings.Isha;

                if (fajrTimeStr && ishaTimeStr) {
                    const [fajrHour, fajrMinute] = fajrTimeStr.split(':').map(Number);
                    const fajrTimeInMinutes = fajrHour * 60 + fajrMinute;

                    const [ishaHour, ishaMinute] = ishaTimeStr.split(':').map(Number);
                    const ishaTimeInMinutes = ishaHour * 60 + ishaMinute;

                    if (currentTimeInMinutes >= ishaTimeInMinutes || currentTimeInMinutes < fajrTimeInMinutes) {
                        prayerElements['Isha'].classList.add('active');
                    }
                }
            }
        }

        fetchPrayerTimesAndStore();
        setInterval(fetchPrayerTimesAndStore, 60 * 60 * 1000);
        setInterval(() => highlightCurrentPrayer(window.lastTimings), 60 * 1000);


        // --- Video Player ---
        const videoPlayer = document.getElementById('displayVideo');
        const videoPlaylist = [
            @foreach($photoDisplay as $item)
                "{{ asset('storage/'.$item->photo_display) }}",
            @endforeach
            // Tambahkan URL video Anda di sini
            // 'https://yourserver.com/videos/video1.mp4',
            // 'https://yourserver.com/videos/video2.mp4',
        ];
        let currentVideoIndex = 0;

        function playNextVideo() {
            if (videoPlaylist.length === 0) {
                console.warn('Video playlist is empty. No videos to play.');
                return;
            }
            currentVideoIndex = (currentVideoIndex + 1) % videoPlaylist.length;
            videoPlayer.src = videoPlaylist[currentVideoIndex];
            videoPlayer.load();
            videoPlayer.play().catch(error => {
                console.error('Error playing video:', error);
                videoPlayer.muted = true;
                videoPlayer.play().catch(err => console.error('Failed to play muted:', err));
            });
        }

        if (videoPlaylist.length > 0) {
            videoPlayer.src = videoPlaylist[currentVideoIndex];
            videoPlayer.load();
            videoPlayer.play().catch(error => {
                console.error('Autoplay prevented:', error);
                videoPlayer.muted = true;
                videoPlayer.play().catch(err => console.error('Failed to play muted:', err));
            });
        } else {
            console.warn('No videos in the playlist. Video player will be empty.');
        }

        videoPlayer.addEventListener('ended', playNextVideo);
        videoPlayer.addEventListener('error', (event) => {
            console.error('Video error encountered:', event);
            playNextVideo();
        });

        document.addEventListener('click', () => {
            if (videoPlayer.paused && videoPlaylist.length > 0) {
                videoPlayer.play().catch(error => {
                    console.error('Manual play failed:', error);
                });
            }
        }, { once: true });

        // --- FUNGSI FULLSCREEN BARU ---
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                // Masuk mode layar penuh
                document.documentElement.requestFullscreen().catch(err => {
                    console.error(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
                });
            } else {
                // Keluar mode layar penuh
                document.exitFullscreen().catch(err => {
                    console.error(`Error attempting to disable full-screen mode: ${err.message} (${err.name})`);
                });
            }
        }

        // Tambahkan event listener ke logo setelah DOM dimuat
        document.addEventListener('DOMContentLoaded', () => {
            const fullscreenLogo = document.getElementById('fullscreenLogo');
            if (fullscreenLogo) {
                fullscreenLogo.addEventListener('click', toggleFullscreen);
            }
        });
    </script>
</body>
</html>