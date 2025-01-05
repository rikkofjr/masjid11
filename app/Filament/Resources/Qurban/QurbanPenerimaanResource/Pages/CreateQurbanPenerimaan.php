<?php

namespace App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource;
use App\Models\Qurban\QurbanPenerimaan;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;

class CreateQurbanPenerimaan extends CreateRecord
{
    protected static string $resource = QurbanPenerimaanResource::class;

    public static function beforeCreate(Forms\Actions\CreateAction $action, array $data): array
    {
        $date = Carbon::now()->format('Y');
        $hijri_year = Hijri::Date($date);

        $data['amil'] = auth()->user()->id;
        $data['hijri'] = $hijri_year; // Hijri year
        $data['nomor_hewan'] = QurbanPenerimaan::where('hijri', $hijri_year)
            ->where('hewan', $data['hewan'])
            ->count() + 1; // Get the count of existing records for this year and type, and increment by 1

        return $data;
    }

}
