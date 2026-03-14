@section('title', 'Artikel masjid')
<div class="container max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Artikel</h1>

    <div class="grid grid-cols-1 gap-6">
        @foreach($artikelsMasjid as $item)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ asset('storage/'.$item->photo) }}" alt="" class="w-full h-50 object-cover rounded mb-4">

                <h2 class="text-xl font-semibold">{{ $item->judul_artikel }} lah </h2>

                <p class="text-gray-600 text-sm mt-2">
                    {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100, '...') }}
                </p>

                <p class="text-gray-400 text-xs mt-2">
                    Dipublikasikan: {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </p>

                <a href="{{ route('artikel.detail', $item->id) }}" class="text-green-600 font-semibold text-sm mt-3 inline-block">Baca Selengkapnya →</a>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $artikelsMasjid->links() }}
    </div>
</div>
