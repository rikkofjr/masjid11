<?php

namespace App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource;
use App\Helpers\Helper;
use App\Models\Qurban\QurbanPenerimaan;
use App\Models\Qurban\QurbanTracking;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateQurbanPenerimaan extends CreateRecord
{
    protected static string $resource = QurbanPenerimaanResource::class;

    /**
     * Manipulasi data sebelum disimpan ke database
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $date = Carbon::now();
        $nowHijriyear = Hijri::Date('Y', $date);

        // Set data tambahan otomatis
        $data['amil'] = auth()->user()->id;
        $data['status_terakhir'] = 'diterima';
        $data['hijri'] = Hijri::ShortDate($date);
        $data['nomor_hewan'] = Helper::qurbanNomorHewan(new QurbanPenerimaan(), $nowHijriyear, $data['jenis_hewan']);

        return $data;
    }

    /**
     * Proses setelah data qurban berhasil dibuat
     */
    protected function afterCreate(): void
    {
        $qurban = $this->record;

        // Simpan log history tracking pertama
        QurbanTracking::create([
            'id' => Str::uuid(),
            'id_qurban_penerimaan' => $qurban->id,
            'status' => 'diterima',
            'keterangan' => 'Hewan qurban diterima oleh panitia',
            'petugas' => $qurban->amil,
        ]);
    }
}
