<?php

namespace App\Filament\Resources\Jamaah\JamaahKeluargaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JamaahAnggotaKeluargaRelationManager extends RelationManager
{
    protected static string $relationship = 'jamaah_anggota_keluarga';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_jamaah')
                    ->required()
                    ->maxLength(255),
                
                    DatePicker::make('tanggal_lahir')
                    ->required(),

                Forms\Components\Hidden::make('id_penanggung_jawab')
                    ->default(auth()->user()->id),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_jamaah')
            ->columns([
                Tables\Columns\TextColumn::make('nama_jamaah'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['id_penanggung_jawab'] = auth()->user()->id;

        return $data;
    }
}
