<?php

namespace App\Filament\Resources\Bendahara\TransaksiKasResource\Pages;

use App\Filament\Resources\Bendahara\TransaksiKasResource;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Bendahara\KelompokTransaksi;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\RawJs;

class CreateTransaksiKas extends CreateRecord
{
    protected static string $resource = TransaksiKasResource::class;

    protected function getFormSchema(): array
    {
        return [

            Section::make('Transaksi Kas')
            ->description('ini adalah transaksi pada kas')
            ->schema([
                ToggleButtons::make('tipe')
                    ->label('Tipe Transaksi')
                    ->options([
                        'penerimaan' => 'PENERIMAAN KAS',
                        'pengeluaran' => 'PENGELUARAN KAS',
                    ])
                    ->icons([
                        'penerimaan' => 'heroicon-m-arrow-left-on-rectangle',
                        'pengeluaran' => 'heroicon-m-arrow-right-start-on-rectangle',
                    ])
                    ->colors([
                        'penerimaan' => 'success',
                        'pengeluaran' => 'danger',
                    ])
                    ->inline()
                    ->required()
                    ->visibleOn('create'),
    
                Select::make('id_kelompok_transaksi')
                    ->label('Kelompok Transaksi')
                    ->options(KelompokTransaksi::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
    
                Select::make('id_jenis_pembayaran')
                    ->label('Jenis pembayaran')
                    ->options(JenisPembayaran::all()->pluck('nama', 'id'))
                    ->default(JenisPembayaran::where('short_name', 'cash')->value('id'))
                    ->required(),
                
                TextInput::make('keterangan')
                    ->label('Keterangan Transaksi')
                    ->required(),
    
                
                TextInput::make('uang')
                    ->label('Jumlah Uang')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->numeric()
                    ->visibleOn('create'),
            ]),    
            
        ];
        
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if($data['tipe'] == 'penerimaan'){
            $data['penerimaan'] = $data['uang'];
        }
        if($data['tipe'] == 'pengeluaran'){
            $data['pengeluaran'] = $data['uang'];
        }
        $data['id_penanggung_jawab'] = auth()->id();
    
        return $data;
    }

    
}
