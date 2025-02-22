<!-- resources/views/filament/pages/zakat-dashboard.blade.php -->
<x-filament::page>
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">Rekapan harian</h1>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">

            @foreach($this->getZakatDataHarian()['jenisZis'] as $jenisZis)
            <section class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                <header class="fi-section-header flex flex-col gap-3 px-6 py-4 border-yellow-300">
                    <div class="flex items-center gap-3">
                        <div class="grid flex-1 gap-y-1">
                            <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                Rekap Harian {{$jenisZis->nama}}
                            </h3>
                             <p class="fi-section-header-description overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400">
                                Jumlah penerimaan harian {{$jenisZis->nama}}
                            </p>
                        </div>
                    </div>
                </header>
                <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10 p-2">
                    @if(isset($this->getZakatDataHarian()['results'][$jenisZis->id]))
                        <table class="table-auto border-collapse border" width="100%">
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
            </section>
            @endforeach
        </div>
    </div>
</x-filament::page>
