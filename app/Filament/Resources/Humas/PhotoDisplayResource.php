<?php

namespace App\Filament\Resources\Humas;

use App\Filament\Resources\Humas\PhotoDisplayResource\Pages;
use App\Filament\Resources\Humas\PhotoDisplayResource\RelationManagers;
use App\Models\Display;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoDisplayResource extends Resource
{
    protected static ?string $model = Display::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('keterangan')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('photo_display')
                    ->label('Video')
                    ->directory('/displays/video')
                    ->required(),
                
                Forms\Components\Checkbox::make('is_active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_display')->label('file'),
                TextColumn::make('keterangan')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePhotoDisplays::route('/'),
        ];
    }
}
