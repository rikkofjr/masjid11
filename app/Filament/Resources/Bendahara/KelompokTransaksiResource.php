<?php

namespace App\Filament\Resources\Bendahara;

use App\Filament\Resources\Bendahara\KelompokTransaksiResource\Pages;
use App\Filament\Resources\Bendahara\KelompokTransaksiResource\RelationManagers;
use App\Models\Bendahara\KelompokTransaksi;
use App\Models\Bendahara\TransaksiKas;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;


class KelompokTransaksiResource extends Resource
{
    protected static ?string $model = KelompokTransaksi::class;

    protected static ? string $navigationLabel = 'Kelompok Transaksi';

    protected static ?string $navigationGroup = 'Bendahara';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
              
                Forms\Components\TextInput::make('nomor_kelompok_kas')
                    ->unique()
                    ->required()
                    ->validationMessages([
                        'unique' => 'Nomor ini sudah terdaftar.',
                        'require' => 'Anda harus mengisi form ini.',
                    ]),
                Forms\Components\TextInput::make('nama')
                    ->required(),

                Forms\Components\Hidden::make('id_penanggung_jawab')
                ->default(auth()->id()),
                    

            ]);
    }
    public static function creating(Task $task)
    {
        $task->id_penanggung_jawab = auth()->id();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_kelompok_kas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKelompokTransaksis::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function mutateFormDataBeforeCreate(array $data): array
    {

        $data['id_penanggung_jawab'] = auth()->id();
    
        return $data;
    }
}
