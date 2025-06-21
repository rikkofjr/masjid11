<?php

namespace App\Filament\Resources\Qurban;

use App\Filament\Resources\Qurban\QurbanPenyimpananResource\Pages;
use App\Filament\Resources\Qurban\QurbanPenyimpananResource\RelationManagers;
use App\Filament\Resources\Qurban\QurbanPenyimpananResource\RelationManagers\StockRelationManager;
use App\Models\Qurban\QurbanPenyimpanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QurbanPenyimpananResource extends Resource
{
    protected static ?string $model = QurbanPenyimpanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationLabel = 'Penyimpanan Qurban';
    protected static ?string $navigationGroup = 'Qurban';
    protected static ?string $title = 'Penyimpanan Daging Qurban';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_gudang_penyimpanan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('nama_gudang_penyimpanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_stock')
                    ->label('Total Stok')
                    ->getStateUsing(function ($record) {
                        return $record->stock()->sum('kuantitas');
                    })
                    ->sortable(),
               Tables\Columns\TextColumn::make('last_stock_update')
                ->label('Terakhir Update Stok')
                ->getStateUsing(function ($record) {
                    return optional($record->stock()->latest('created_at')->first())->created_at?->format('d-m-Y H:i');
                })
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StockRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQurbanPenyimpanans::route('/'),
            'create' => Pages\CreateQurbanPenyimpanan::route('/create'),
            'edit' => Pages\EditQurbanPenyimpanan::route('/{record}/edit'),
        ];
    }
}
