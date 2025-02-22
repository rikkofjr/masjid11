<?php

namespace App\Filament\Resources\ZisPenerimaanResource\Pages\Zis;

use App\Filament\Resources\Zis\ZisPenerimaanResource as ZisZisPenerimaanResource;
use Filament\Resources\Pages\Page;

class ZisRekapHarian extends Page
{
    protected static string $resource = ZisZisPenerimaanResource::class;

    protected static string $view = 'filament.resources.zis-penerimaan-resource.pages.zis.zis-rekap-harian';
}
