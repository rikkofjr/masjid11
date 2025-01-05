<!-- resources/views/filament/pages/zakat-dashboard.blade.php -->
<x-filament::page>
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">Rekapan harian</h1>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">

            @foreach($this->getZakatDataHarian()['jenisZis'] as $jenisZis)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold">Rekap Harian {{$jenisZis->nama}}</h2>
                
                {{-- Check if there is data for this jenisZis in the results --}}
                @if(isset($this->getZakatDataHarian()['results'][$jenisZis->id]))
                    <table class="table-auto border-collapse border">
                        <thead class="border">
                            <tr>
                                <td class="border px-4 py-2">Tanggal</td>
                                <td class="border px-4 py-2">Uang</td>
                                <td class="border px-4 py-2">Uang Infaq</td>
                                <td class="border px-4 py-2">Beras</td>
                                <td class="border px-4 py-2">Beras Infaq</td>
                                <td class="border px-4 py-2">Jiwa</td>
                            </tr>
                        </thead>
                        <tbody class="border-slate-950">
                            @foreach ($this->getZakatDataHarian()['results'][$jenisZis->id] as $itemHarian)
                                <tr>
                                    <td class="border px-4 py-2">{{ $itemHarian->date }}</td>
                                    <td class="border px-4 py-2">{{ number_format($itemHarian->uang_harian) }}</td>
                                    <td class="border px-4 py-2">{{ number_format($itemHarian->uang_infaq_harian) }}</td>
                                    <td class="border px-4 py-2">{{ number_format($itemHarian->beras_harian, 2) }}</td>
                                    <td class="border px-4 py-2">{{ number_format($itemHarian->beras_infaq_harian, 2) }}</td>
                                    <td class="border px-4 py-2">{{ number_format($itemHarian->jiwa_harian) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No data available for this type of ZIS</p>
                @endif
            </div>
            @endforeach

        </div>
    </div>
</x-filament::page>
