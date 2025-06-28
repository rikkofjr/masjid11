<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\Bendahara\KasOverview;
use App\Filament\Widgets\Bendahara\PenerimaanKasChart;
use App\Filament\Widgets\Bendahara\PengeluaranKasChart;
use App\Filament\Widgets\Jamaah\JamaahOverview;
use App\Filament\Widgets\PembayaranZisOverview;
use Filament\Pages\Page;

class LayananMasjid extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.layanan-masjid';

    public static function getLabel(): string
    {
        return 'Layanan Masjid';
    }

    public function getHeaderWidgets():array {
        return [
            KasOverview::class,
            PenerimaanKasChart::class,
            PengeluaranKasChart::class,
            JamaahOverview::class,
            
        ];

    }
}
