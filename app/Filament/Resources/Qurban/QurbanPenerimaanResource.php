<?php

namespace App\Filament\Resources\Qurban;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource\Pages;
use App\Filament\Resources\Qurban\QurbanPenerimaanResource\RelationManagers;
use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Models\Qurban\QurbanPenerimaan;
use App\Models\Qurban\QurbanTracking;
use Carbon\Carbon;
use Filament\Actions\Modal\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
// use Filament\Tables\Actions\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class QurbanPenerimaanResource extends Resource
{
    protected static ?string $model = QurbanPenerimaan::class;
    protected static ? string $navigationLabel = 'Penerimaan Qurban';
    protected static ?string $navigationGroup = 'Qurban';
    protected static ?string $title = 'Penerimaan Qurban';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jenis_hewan')
                    ->options([
                        'Sapi' => 'Sapi',
                        'Kambing' => 'Kambing',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('atas_nama')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('nama_lain')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('permintaan')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('nomor_handphone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('disaksikan')
                    ->required(),
                Forms\Components\Textarea::make('keterangan')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('photo_hewan')
                    ->image()
                    ->directory('penerimaan-qurban')
                    ->preserveFilenames()
                    ->afterStateUpdated(function ($state) {
                        if ($state) {
                            $path = storage_path('app/penerimaan-qurban/' . $state);

                            // Resize ke max width 1200px + compress ke 80% ukuran awal
                            try {
                                $finalSize = ImageHelper::compressToTargetSize($path, 1200, 0.8, 50);
                                info("Compress sukses, size akhir: " . $finalSize . " byte");
                            } catch (\Exception $e) {
                                report($e);
                            }
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_hewan')
                ->searchable(),
                
                Tables\Columns\TextColumn::make('jenis_hewan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('atas_nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lain')
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        // Convert newline characters to <br> tags
                        return nl2br($record->nama_lain);
                    })
                    ->html() ,
                Tables\Columns\TextColumn::make('permintaan')
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        // Convert newline characters to <br> tags
                        return nl2br($record->permintaan);
                    })
                    ->html() ,
                Tables\Columns\TextColumn::make('nomor_handphone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('disaksikan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status_terakhir')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diterima' => 'info',
                        'disembelih' => 'warning',
                        'diproses' => 'gray',
                        'terkirim' => 'success',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('hijri')
                    ->date('Y'),
                Tables\Columns\TextColumn::make('nama_amil.name')
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
                //Tables\Filters\TrashedFilter::make(),

                SelectFilter::make('hijri')
                ->label('Tahun Hijriah')
                ->options(function () {
                    $years = DB::table('tb_qurban_penerimaan')
                        ->selectRaw('YEAR(hijri) as year')
                        ->distinct()
                        ->pluck('year', 'year')
                        ->sortDesc(); 
                    return $years;
                })
                ->default(function(){
                    $date = Carbon::now();
                    $nowHijriYear = Hijri::date('Y', $date);
                    return $nowHijriYear ;
                })
                ->searchable()
                ->query(function ($query, $state) {
                    return $state ? $query->whereYear('hijri', $state) : $query;
                }),


            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('ubahStatus')
                ->label('Ubah Status')
                ->form([
                    Forms\Components\Select::make('status')
                        ->options([
                            'diterima' => 'Diterima',
                            'disembelih' => 'Disembelih',
                            'diproses' => 'Diproses',
                            'terkirim' => 'Terkirim',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('keterangan')
                        ->label('Keterangan'),
                ])
                ->action(function (array $data, $record) {
                    // Update status di tabel utama
                    $record->update([
                        'status_terakhir' => $data['status'],
                    ]);

                    // Simpan ke history tracking
                    QurbanTracking::create([
                        'id_qurban_penerimaan' => $record->id,
                        'status' => $data['status'],
                        'keterangan' => $data['keterangan'],
                        'petugas' => auth()->user()->id,
                        'created_at' => now(),
                    ]);
                })
                ->icon('heroicon-o-pencil-square'),

                Tables\Actions\Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn (QurbanPenerimaan $record) => route('print.qurban.detail', $record->id))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
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
            'index' => Pages\ListQurbanPenerimaans::route('/'),
            'create' => Pages\CreateQurbanPenerimaan::route('/create'),
            'view' => Pages\ViewQurbanPenerimaan::route('/{record}'),
            'edit' => Pages\EditQurbanPenerimaan::route('/{record}/edit'),
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
