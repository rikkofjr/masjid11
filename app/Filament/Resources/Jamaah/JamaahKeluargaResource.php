<?php

namespace App\Filament\Resources\Jamaah;

use App\Filament\Resources\Jamaah\JamaahKeluargaResource\Pages;
use App\Filament\Resources\Jamaah\JamaahKeluargaResource\RelationManagers;
use App\Filament\Resources\Jamaah\JamaahKeluargaResource\RelationManagers\JamaahAnggotaKeluargaRelationManager;
use App\Models\Jamaah\JamaahKeluarga;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JamaahKeluargaResource extends Resource
{
    protected static ?string $model = JamaahKeluarga::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $title = 'Penerimaan Qurban';
    protected static ?string $navigationLabel = 'Keluarga Jamaah';
    protected static ?string $navigationGroup = 'Jamaah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ToggleButtons::make('tipe')
                        ->label('Tipe Jamaah')
                        ->options([
                            'internal' => 'JAMAAH INTERNAL',
                            'external' => 'JAMAAH EXTERNAL',
                        ])
                        ->icons([
                            'internal' => 'heroicon-m-arrow-left-on-rectangle',
                            'external' => 'heroicon-m-arrow-right-start-on-rectangle',
                        ])
                        ->colors([
                            'internal' => 'info',
                            'external' => 'danger',
                        ])
                        ->inline()
                        ->required()
                        ->default('internal'),

                Forms\Components\Select::make('status')
                    ->options([
                        'biasa' => 'Jamaah Biasa',
                        'donatur' => 'Jamaah Donatur',
                        'mustahiq' => 'Jamaah Mustahiq',
                    ])
                    ->default('biasa')
                    ->required(),
                Forms\Components\TextInput::make('nama_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_keluarga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jamaah_anggota_keluarga_count')
                    ->label('Anggota Keluarga')
                    ->counts('jamaah_anggota_keluarga'),

                Tables\Columns\TextColumn::make('penanggung_jawab.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                // Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('status')
                ->options([
                    'donatur' => 'Donatur',
                    'mustahiq' => 'Mustahiq',
                    'biasa' => 'Biasa',
                ])
            ])
            ->actions([
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
            JamaahAnggotaKeluargaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJamaahKeluargas::route('/'),
            'create' => Pages\CreateJamaahKeluarga::route('/create'),
            'edit' => Pages\EditJamaahKeluarga::route('/{record}/edit'),
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
