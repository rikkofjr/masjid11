<div>

    <section class="py-8 md:py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <h1 class="font-bold text-gray-700 text-5xl mb-10">{{$artikel->judul_artikel}}</h1>

            <div class="col">
            
                <div class="">
                    <img src="{{ asset('storage/'.$artikel->photo) }}" alt="{{ $artikel->judul_artikel }}" class="w-full h-50 object-cover">

                    <div class="p-5">
                        <p class="text-xl text-gray-800 mb-2">
                            {{ $artikel->deskripsi }}
                        </p>

                        <p class="text-gray-500 text-xs">
                            Dipublikasikan pada {{ \Carbon\Carbon::parse($artikel->created_at)->translatedFormat('d F Y') }}
                        </p>
                        
                       
                    </div>
                </div>

            </div>


        </div> <!-- container.// -->

    </section>

</div>
