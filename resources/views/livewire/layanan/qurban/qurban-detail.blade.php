
<div>
    <div
        wire:loading
        wire:target="nextStatus"
        class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
    >
        <div class="text-white text-2xl font-bold animate-pulse">
            🔄 Memproses...
        </div>
    </div>
    <div class="container mx-auto p-4 pb-24 relative">

        

        <!-- Header + Tombol -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-2xl font-bold">Tracking Qurban</h3>
            <a href={{route('print.qurban.detail', $penerimaan->id)}}
                class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded shadow">
                Print
            </a>
        </div>

        <!-- Pesan Sukses -->
        <x-livewire-alert::scripts />
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-300 rounded">
                <tbody>
                    <tr class="border-b">
                        <td colspan="2" class="p-2 text-center">
                            <img src="{{ asset('storage/' . $penerimaan->photo_hewan) }}" alt=""
                                class="object-cover rounded shadow mx-auto">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-2 text-left font-semibold">Atas Nama</th>
                        <td class="p-2">{{ $penerimaan->atas_nama }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-2 text-left font-semibold">Nama Lain</th>
                        <td class="p-2">{!! nl2br(e( $penerimaan->nama_lain)) !!}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-2 text-left font-semibold">No - Jenis Hewan</th>
                        <td class="p-2">{{ $penerimaan->nomor_hewan }} - {{ $penerimaan->jenis_hewan }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-2 text-left font-semibold">Status</th>
                        <td class="p-2" wire:poll.500ms >{{ $penerimaan->status_terakhir }}</td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="">
            <h4 class="text-lg font-bold mb-4">Riwayat Tracking</h4>

            <div class="relative border-l-2 border-blue-500 ml-4">
                @forelse ($penerimaan->trackings as $track)
                    <div class="mb-6 ml-4">
                        <div class="absolute w-3 h-3 bg-blue-500 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                        <div class="text-sm font-semibold text-gray-800">{{ $track->status }}</div>
                        <div class="text-xs text-gray-600">{{ $track->created_at->format('d M Y H:i') }}</div>
                        <div class="text-xs text-gray-600">Petugas: <span class="font-semibold">{{ $track->profile_petugas->name ?? '-' }}</span></div>
                    </div>
                @empty
                    <div class="ml-4 text-sm text-gray-500">Belum ada data tracking.</div>
                @endforelse
            </div>

            <button wire:click="$set('showTracking', false)"
                class="mt-6 w-full bg-gray-600 hover:bg-gray-700 text-white py-2 rounded shadow">
                Tutup
            </button>
        </div>

        <!-- Tombol Update -->
        @if ($penerimaan->status_terakhir != 'terkirim')
            <button
                type="button"
                wire:click.debounce.500ms="nextStatus"
                wire:loading.class="opacity-50 cursor-not-allowed"
                wire:loading.attr="disabled"
                class="flex items-center justify-center font-semibold text-black text-lg gap-3 transition ease-in-out duration-300 bg-green-600 py-5 px-6 fixed bottom-0 left-0 w-full text-center z-50"
                >
                Update ke Status Selanjutnya
            </button>


        @endif

    </div>
</div>

