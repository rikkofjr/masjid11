<div>
    <section class="py-8 md:py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <div class="flex flex-col xl:flex-row items-center justify-between mb-20 md:mb-40">
                <div class="mx-auto xl:mx-0 mb-20 xl:mb-0">
                    <img src="{{asset('assets-internal/mosque.png')}}" alt="Image" class="w-[400px] md:w-[200px] w-[200px] max-w-full h-auto">
                </div>

                <div class="mx-auto xl:mx-0 text-center xl:text-left">
                    <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Selamat Datang Di Website {{$profileMasjid->nama_masjid ?? '-'}}</h1>

                    <p class="font-normal text-gray-400 text-sm md:text-lg mb-5">
                        {{$profileMasjid->deskripsi ?? '-'}}
                    </p>

                    <a href="#" class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                        See more
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                </div>
            </div>

        </div> <!-- container.// -->

    </section>

    <section class="py-8 md:py-16" style="background-color: rgba(250,250,250,0.6);">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h1 class="font-bold text-gray-700 text-3xl mb-10">Program Unggulan</h1>
            <div class="key-feature-grid mt-10 grid grid-cols-2 gap-7 md:grid-cols-3 xl:grid-cols-3">
                @foreach($programMasjid as $item)
                <div class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg">
                    <div>
                    <h3 class="h4 text-xl lg:text-3xl ">{{$item->judul_program ?? '-'}}</h3>
                    <p>{{$item->deskripsi ?? '-'}}</p>
                    </div>
                    <span class="icon mt-4">
                    <img class="objec-contain" src="images/icons/feature-icon-1.svg" alt="">
                    </span>
                </div>
                @endforeach
            </div>

        </div> <!-- container.// -->

    </section>

    <section class="py-8 md:py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h1 class="font-bold text-gray-700 text-3xl mb-10">Artikel Terbaru</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($artikelMasjid as $item)
                
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition duration-300">
                        <a href="{{ route('artikel.detail', $item->id) }}">
                        <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->judul_artikel }}" class="w-full h-48 object-cover">

                        <div class="p-5">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->judul_artikel }}</h2>

                            <p class="text-gray-600 text-sm mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                            </p>

                            <p class="text-gray-500 text-xs">
                                Dipublikasikan pada {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                            </p>
                            
                            <a href="{{ route('artikel.detail', $item->id) }}" class="text-green-600 font-semibold text-sm mt-3 inline-block">
                                Baca Selengkapnya →
                            </a>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>


        </div> <!-- container.// -->

    </section>
</div>
