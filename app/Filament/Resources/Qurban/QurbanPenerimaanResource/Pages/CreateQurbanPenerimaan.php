<?php

namespace App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource;
use App\Helpers\Helper;
use App\Models\Qurban\QurbanPenerimaan;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateQurbanPenerimaan extends CreateRecord
{
    protected static string $resource = QurbanPenerimaanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $date = Carbon::now();
        $nowHijriyear = Hijri::Date('Y', $date);

        $data['amil'] = auth()->user()->id;

        $data['hijri'] = Hijri::ShortDate($date); // Hijri year
        $data['nomor_hewan'] = Helper::qurbanNomorHewan(new QurbanPenerimaan(), $nowHijriyear, $data['jenis_hewan']);

        return $data;
    }

}
