<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LayananMasjid extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.layanan-masjid';

    public static function getLabel(): string
    {
        return 'Layanan Masjid';
    }
}
