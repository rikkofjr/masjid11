<?php

namespace App\Filament\Resources\Bendahara;

use App\Filament\Resources\Bendahara\TransaksiKasResource\Pages;
use App\Filament\Resources\Bendahara\TransaksiKasResource\RelationManagers;
use App\Models\Bendahara\JenisPembayaran;
use App\Models\Bendahara\KelompokTransaksi;
use App\Models\Bendahara\TransaksiKas;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class TransaksiKasResource extends Resource
{
    protected static ?string $model = TransaksiKas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Bendahara';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

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
                    
                    Textarea::make('keterangan_tambahan')
                        ->label('Keterangan Tambahan'),

                    TextInput::make('uang')
                        ->label('Jumlah Uang')
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->visibleOn('create'),
                ]),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([                
                Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Posting')
                ->dateTime(),

                Tables\Columns\TextColumn::make('kelompok_transaksi.nama')
                    ->label('Nama Kelompok')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('keterangan')
                ->sortable(),
                
                Tables\Columns\TextColumn::make('penerimaan')
                    ->searchable()
                    ->numeric(),
                Tables\Columns\TextColumn::make('pengeluaran')
                    ->searchable()
                    ->numeric(),
                
                Tables\Columns\TextColumn::make('penerimaan')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                    ]),
                Tables\Columns\TextColumn::make('pengeluaran')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                    ]),
            ])
            ->filters([
                
                //Tables\Filters\TrashedFilter::make(),
                
                SelectFilter::make('id_kelompok_transaksi')
                ->label('Kelompok Transaksi Kas')
                ->searchable()
                ->relationship('kelompok_transaksi', 'nama'),

                Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from')->label('Tanggal Mulai'),
                    DatePicker::make('created_until')->label('Tanggal Berakhir'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['created_from'] ?? null) {
                        $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }
                    if ($data['created_until'] ?? null) {
                        $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }

                    return $indicators;
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTransaksiKas::route('/'),
            'create' => Pages\CreateTransaksiKas::route('/create'),
            'edit' => Pages\EditTransaksiKas::route('/{record}/edit'),
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
