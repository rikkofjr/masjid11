<?php

namespace App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Zis\ZisPenerimaanResource;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Zis\JenisZis;
use Carbon\Carbon;
use Closure;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Support\RawJs;
use Illuminate\Support\Number;

class CreateZisPenerimaan extends CreateRecord
{
    use HasWizard;
    protected static string $resource = ZisPenerimaanResource::class;


    public function getSteps(){
        
        $date = Carbon::now();
        $hijri = Hijri::ShortDate($date);

        return [
            Step::make('Informasi Pembayaran')
            ->schema([
                Hidden::make('amil')
                ->required()
                ->default(auth()->user()->id),
                       
                Forms\Components\Select::make('id_jenis_zis')
                ->label('Jenis Zakat Yang dibayar')
                ->options(JenisZis::all()->pluck('nama', 'id'))
                ->searchable()
                ->required(),
        
                Forms\Components\TextInput::make('atas_nama')
                    ->required(),
                Forms\Components\Textarea::make('nama_lain')
                    ->columnSpanFull(),
                
                Forms\Components\TextInput::make('jumlah_jiwa')
                    ->label('Pilih Jumlah jiwa')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required(),
                
                
                Section::make('Zakat Uang')
                    ->description('Masukan Nominal Uang perjiwa')
                    ->schema([

                    Forms\Components\TextInput::make('uang_perjiwa')
                    ->label('Uang per jiwa')
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->columnspan(6),

                    Forms\Components\TextInput::make('uang_infaq')
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->columnspan(6),
                ])
                ->extraAttributes([
                    'style' => '
                        background-color: #ccc;
                        @media (prefers-color-scheme: dark) {
                            background-color: #333
                        }'
                ])
                ->columns(12),

                Section::make('Zakat Beras')
                    ->description('Gunakan angka desimal dengan titik (contoh : 3.25) ')
                    ->schema([
                    TextInput::make('beras_perjiwa')
                    ->numeric()
                    ->label('Beras per jiwa')
                    //->default(3.50)
                    ->columnspan(6),

                    TextInput::make('beras_infaq')
                    ->numeric()
                    ->columnspan(6),

                ])->columns(12),

                
                Hidden::make('hijri')
                ->default($hijri)
                ->required(),

            ]),


            Step::make('Konfirmasi')
            ->schema([
                
                Placeholder::make('idJenisZis')
                ->label('Jenis Zis')
                ->content(function (Get $get){
                    $nama_zis = JenisZis::where('id', $get('id_jenis_zis'))->first();
                    if(!$nama_zis){
                        return $get('id_jenis_zis');
                    }else{
                        return $nama_zis->nama;
                    }
                }),
                
                Placeholder::make('atasNama')
                ->label('Zakat Atas Nama')
                ->content(function (Get $get){
                    return $get('atas_nama') ;
                }),
                
                Placeholder::make('jumlahJiwa')
                ->label('Jumlah Jiwa')
                ->content(function (Get $get){
                    return $get('jumlah_jiwa') ;
                }),

                /// Ambil nominal zakat uang
                Section::make('Nominal Zakat Uang')
                ->visible(fn (Get $get) => $get('uang_perjiwa') >= 1 || $get('uang_infaq') >= 1 )
                ->schema([
                    
                    ///input uang zakat

                    Placeholder::make('uangZakat')
                    ->label('Total Zakat Dibayarkan')
                    ->content(function (Get $get){
                        $uangPerJiwa = (float) preg_replace('/[^0-9.]/', '', $get('uang_perjiwa')); 
                        $jumlahJiwa = (int) $get('jumlah_jiwa'); 
                        $total = $uangPerJiwa * $jumlahJiwa;
                        return number_format($total);
                    }),
                                        
                    Placeholder::make('uangInfaq')
                    ->label('Uang Infaq')
                    ->content(function (Get $get){
                        if(!$get('uang_infaq')){
                            return 0;    
                        }
                        $uangInfaq = (float) preg_replace('/[^0-9.]/', '', $get('uang_infaq'));
                        return number_format($uangInfaq);
                    }),
                    
                    Placeholder::make('TotalPembayaranUang')
                    ->label('Total Pembayaran')
                    ->content(function (Get $get){
                        if(!$get('uang_perjiwa')){
                            return 0;    
                        }
                        $uangPerJiwa = (float) preg_replace('/[^0-9.]/', '', $get('uang_perjiwa')); 
                        $uangInfaq = (float) preg_replace('/[^0-9.]/', '', $get('uang_infaq')); 
                        $jumlahJiwa = (int) $get('jumlah_jiwa'); 
                        $total = $uangPerJiwa * $jumlahJiwa + $uangInfaq;
                        return number_format($total);
                    }),

                    Select::make('id_jenis_pembayaran')
                    ->label('Jenis pembayaran')
                    ->options(JenisPembayaran::all()->pluck('nama', 'id'))
                    ->default(JenisPembayaran::where('short_name', 'cash')->value('id'))
                    ->required(),
                    // ->searchable(),
    
                ]),
                
                
                /// Ambil nominal zakat Beras
                Section::make('Nominal Zakat Beras')
                ->visible(fn (Get $get) => $get('beras_perjiwa') >= 1)
                ->schema([


                    Placeholder::make('TotalBerasZakat')
                    ->label('Total beras infaq')
                    ->content(function (Get $get){
                        $total = $get('beras_perjiwa') * $get('jumlah_jiwa');
                        return number_format($total, 2);
                    }),
                    
                    Placeholder::make('TotalBerasInfaq')
                    ->label('Total beras infaq')
                    ->content(function (Get $get){
                        $total = $get('beras_infaq');
                        return number_format($total,2);
                    }),

                    Placeholder::make('TotalPembayaranBeras')
                    ->label('Total Pembayaran')
                    ->content(function (Get $get){
                        $total = ($get('beras_perjiwa') * $get('jumlah_jiwa')) + $get('beras_infaq');
                        return number_format($total, 2);
                    }),

                ]),

                Select::make('status_pembayaran')
                ->options([
                    'PAID' => 'PAID',
                    'PENDING' => 'PENDING',
                    'CANCEL' => 'CANCEL',
                ])
                ->default('PAID'),

            ])
        ];
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if($data['uang_perjiwa'] > 1){
            $data['uang'] = $data['uang_perjiwa'] * $data['jumlah_jiwa'];
        }
        if($data['beras_perjiwa'] > 1){
            $data['id_jenis_pembayaran'] = JenisPembayaran::where('short_name', 'beras')->value('id');
            $data['beras'] = $data['beras_perjiwa'] * $data['jumlah_jiwa'];
        }
       
    
        return $data;
    }
}
