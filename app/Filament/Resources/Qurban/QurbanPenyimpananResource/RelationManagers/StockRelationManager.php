<?php

namespace App\Filament\Resources\Qurban\QurbanPenyimpananResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Facades\Filament;

class StockRelationManager extends RelationManager
{
    protected static string $relationship = 'stock';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kuantitas')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),
                Hidden::make('id_user')
                    ->default(Filament::auth()->id()),
                Hidden::make('status')
                    ->default('ok'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('kuantitas')
                    ->label('Jumlah'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User ID'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Input')
                    ->dateTime('d-m-Y H:i'),
            ])
            ->headerActions([
                // Tombol Tambah
                Action::make('TambahStock')
                    ->label('Tambah Stock')
                    ->icon('heroicon-m-plus-circle')
                    ->color('success')
                    ->form([
                        TextInput::make('kuantitas')
                            ->label('Jumlah')
                            ->numeric()
                            ->required(),
                        Hidden::make('id_user')
                            ->default(Filament::auth()->id()),
                        Hidden::make('status')
                            ->default('ok'),
                    ])
                    ->action(function (array $data) {
                        $this->getRelationship()->create([
                            'kuantitas' => abs($data['kuantitas']),
                            'id_user'   => $data['id_user'],
                            'status'    => $data['status'],
                        ]);
                    }),

                // Tombol Kurang
                Action::make('KurangStock')
                    ->label('Kurang Stock')
                    ->icon('heroicon-m-minus-circle')
                    ->color('danger')
                    ->form([
                        TextInput::make('kuantitas')
                            ->label('Jumlah')
                            ->numeric()
                            ->required(),
                        Hidden::make('id_user')
                            ->default(Filament::auth()->id()),
                        Hidden::make('status')
                            ->default('ok'),
                    ])
                    ->action(function (array $data) {
                        $this->getRelationship()->create([
                            'kuantitas' => -abs($data['kuantitas']),
                            'id_user'   => $data['id_user'],
                            'status'    => $data['status'],
                        ]);
                    }),
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
}
