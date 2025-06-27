<div class="container mx-auto p-4 pb-24 relative" wire:poll.500ms>

    <!-- Header + Tombol -->
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-2xl font-bold">Tracking Qurban</h3>
        <button wire:click="openTracking"
            class="text-sm bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded shadow">
            Lihat Rincian Tracking
        </button>
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
                    <td class="p-2">{{ $penerimaan->nama_lain }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left font-semibold">No - Jenis Hewan</th>
                    <td class="p-2">{{ $penerimaan->nomor_hewan }} - {{ $penerimaan->jenis_hewan }}</td>
                </tr>
                <tr class="border-b">
                    <th class="p-2 text-left font-semibold">Status</th>
                    <td class="p-2">{{ $penerimaan->status_terakhir }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="/qurban-tracking"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-center block transition">
            Kembali
        </a>
    </div>

    <!-- Tombol Update -->
    @if ($penerimaan->status_terakhir != 'terkirim')
        <div class="flex items-center justify-center xl:justify-start font-semibold text-black text-lg gap-3 hover:text-white transition ease-in-out duration-300 bg-green-600 outline outline-offset-2 py-5 px-6 fixed bottom-0 left-0 w-full bg-blue-600 text-white text-center text-lg py-3 cursor-pointer z-50"
            wire:click="nextStatus">
            Update ke Status Selanjutnya
        </div>
    @endif

    <!-- Modal Tracking -->
    @if ($showTracking)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded w-11/12 max-w-md shadow-lg">
                <h4 class="text-xl font-bold mb-3">Rincian Tracking</h4>
                <ul class="space-y-2 max-h-64 overflow-y-auto">
                    @forelse ($penerimaan->trackings as $track)
                        <li class="border-b pb-2">
                            <div><span class="font-semibold">Status:</span> {{ $track->status }}</div>
                            <div><span class="font-semibold">Waktu:</span> {{ $track->created_at->format('d M Y H:i') }}</div>
                            <div><span class="font-semibold">Petugas:</span> {{ $track->profile_petugas->name }}</div>
                        </li>
                    @empty
                        <li>Tidak ada data tracking.</li>
                    @endforelse
                </ul>
                <button wire:click="$set('showTracking', false)"
                    class="mt-4 w-full bg-gray-500 text-white py-2 rounded">Tutup</button>
            </div>
        </div>
    @endif

</div>
