<?php

namespace App\Filament\Resources\Profile;

use App\Filament\Resources\Profile\ProfileMasjidResource\Pages;
use App\Filament\Resources\Profile\ProfileMasjidResource\RelationManagers;
use App\Models\ProfileMasjid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileMasjidResource extends Resource
{
    protected static ?string $model = ProfileMasjid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Profile Masjid';
    protected static ?string $title = 'Profile Masjid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_masjid')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat_masjid')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->default('-')
                    ->maxLength(255),
                
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('profile-masjid'),

                Forms\Components\TextInput::make('no_handphone')
                    ->required()
                    ->label('Nomor Telephone')
                    ->maxLength(255),

                    Forms\Components\Checkbox::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_masjid'),
                TextColumn::make('alamat_masjid'),
                TextColumn::make('no_handphone')
                ->label('Nomor Telephone'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfileMasjids::route('/'),
            'create' => Pages\CreateProfileMasjid::route('/create'),
            'edit' => Pages\EditProfileMasjid::route('/{record}/edit'),
        ];
    }
}
