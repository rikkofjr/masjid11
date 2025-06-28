<?php

namespace App\Filament\Pages\Qurban;

use App\Filament\Widgets\Qurban\QurbanPemotonganOverview;
use App\Filament\Widgets\Qurban\QurbanPenyimpananOverview;
use App\Livewire\Jam;
use Filament\Pages\Page;

class QurbanDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Dashboard Qurban';
    protected static ?string $title = 'Dashboard Qurban Tahun ini';
    protected static ?string $navigationGroup = 'Qurban';
    protected static string $view = 'filament.pages.qurban.qurban-dashboard';

    protected static bool $shouldRenderHeader = false;

    public static function getLabel(): string
    {
        return 'Dashboard Qurban';
    }

    public function getHeaderWidgets(): array
    {
        return [
            Jam::class,
            QurbanPemotonganOverview::class,
            QurbanPenyimpananOverview::class,
        ];
    }
}
