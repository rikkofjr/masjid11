<?php

namespace App\Livewire;

use Filament\Widgets\Widget;

class Jam extends Widget
{
    protected static string $view = 'livewire.jam';
    protected int | string | array $columnSpan = 'full';

}
