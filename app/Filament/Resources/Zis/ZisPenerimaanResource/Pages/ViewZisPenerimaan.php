<?php

namespace App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;

use App\Filament\Resources\Zis\ZisPenerimaanResource;
use App\Models\Zis\ZisPenerimaan;
use Filament\Resources\Pages\Page;

class ViewZisPenerimaan extends Page
{
    public $viewZisPenerimaan;

    protected static string $resource = ZisPenerimaanResource::class;

    protected static string $view = 'filament.resources.zis.zis-penerimaan-resource.pages.view-zis-penerimaan';


    public function mount($record)
    {
        $this->viewZisPenerimaan = ZisPenerimaan::findOrFail($record); // Retrieve the order by ID
    }

    protected function getViewData(): array
    {
        return [
            'viewZisPenerimaan' => $this->viewZisPenerimaan,
        ];
    }



}
