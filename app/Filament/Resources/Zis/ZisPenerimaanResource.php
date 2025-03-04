<?php

namespace App\Filament\Resources\Zis;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Zis\ZisPenerimaanResource\Pages;
use App\Filament\Resources\Zis\ZisPenerimaanResource\Pages\CreatePembayaranZis;
use App\Filament\Resources\Zis\ZisPenerimaanResource\RelationManagers;
use App\Filament\Widgets\PembayaranZisOverview;
use App\Filament\Widgets\ZisOverview;
use App\Models\Zis\JenisZis;
use App\Models\Zis\ZisPenerimaan;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ZisPenerimaanResource extends Resource
{
    protected static ?string $model = ZisPenerimaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'ZIS';
    protected static ?string $title = 'Penerimaan Zis';
    protected static ?string $navigationLabel = 'Penerimaan Zis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(isIndividual:true, isGlobal:false)
                    ->label('kode')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('atas_nama')
                    ->label('Nama')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('jumlah_jiwa')
                ->numeric()
                ->sortable(),
                
                Tables\Columns\TextColumn::make('jenis_zis.nama')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('uang')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                    ]),

                Tables\Columns\TextColumn::make('uang_infaq')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                    ]),
                Tables\Columns\TextColumn::make('beras')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                    ]),
                Tables\Columns\TextColumn::make('beras_infaq')
                    ->numeric()
                    ->sortable()->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                    ]),
                Tables\Columns\TextColumn::make('jenis_pembayaran.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hijri')
                    ->label('Tahun Hijriah')
                    ->formatStateUsing(function ($state, $record) {
                        // Assuming 'hijri_date' column stores the date in the given format
                        $hijriDate = Carbon::createFromFormat('Y-m-d', $record->hijri);
                        return $hijriDate->format('Y');
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('nama_amil.name')
                    ->label('Nama Amil')
                    ->searchable(),

         
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('hiri')
                ->label('Tahun Hijriah')
                ->options(function () {
                    $years = DB::table('tb_zis_penerimaan')
                        ->selectRaw('YEAR(hijri) as year')
                        ->distinct()
                        ->pluck('year', 'year')
                        ->sortDesc();
                        
                    return $years;
                })
                ->default(function(){
                    $date = Carbon::now();
                    $hijriDate = Hijri::date('Y', $date);
                    return $hijriDate ;
                })
                ->searchable()
                ->query(function ($query, $state) {
                    return $state ? $query->whereYear('hijri', $state) : $query;
                }),
                    

                SelectFilter::make('id_jenis_zis')
                ->label('Jenis Zakat')
                ->relationship('jenis_zis', 'nama'),
                
                SelectFilter::make('id_jenis_pembayaran')
                ->label('Jenis Pembayaran')
                ->relationship('jenis_pembayaran', 'nama'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZisPenerimaans::route('/'),
            'create' => Pages\CreateZisPenerimaan::route('/create'),
            'view' => Pages\ViewZisPenerimaan::route('/{record}'),
            'edit' => Pages\EditZisPenerimaan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
