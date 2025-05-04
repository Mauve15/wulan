<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use App\Models\Diskon;
use Filament\Forms\Form;
use App\Models\Penjualan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PenjualanResource\Pages;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input untuk kode penjualan
                Forms\Components\TextInput::make('kode_penjualan')
                    ->required()
                    ->maxLength(255)
                    ->label('Kode Penjualan'),

                // Input untuk tanggal penjualan
                Forms\Components\DatePicker::make('tanggal_penjualan')
                    ->required()
                    ->label('Tanggal Penjualan'),

                // Pilihan diskon
                Forms\Components\Select::make('diskon_id')
                    ->label('Diskon')
                    ->options(Diskon::all()->pluck('nama_diskon', 'id'))
                    ->searchable()
                    ->nullable(),

                // Tabel untuk memilih barang yang dijual
                Forms\Components\Repeater::make('detailPenjualans')
                    ->schema([
                        // Pilih barang
                        Forms\Components\Select::make('barang_id')
                            ->label('Barang')
                            ->options(Barang::all()->pluck('nama_barang', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $barang = Barang::find($state);
                                if ($barang) {
                                    $set('harga_jual', $barang->harga_jual);
                                }
                            }),

                        // Input jumlah barang yang dijual
                        Forms\Components\TextInput::make('jumlah_beli')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->label('Jumlah Beli'),

                        Forms\Components\TextInput::make('harga_jual')
                            ->numeric()
                            ->minValue(0)
                            ->required()
                            ->label('Harga Jual'),


                        // Input diskon untuk tiap barang
                        Forms\Components\Select::make('diskon_id')
                            ->label('Diskon per Barang')
                            ->options(Diskon::all()->pluck('jumlah_diskon', 'id'))
                            ->searchable()
                            ->nullable(),

                    ])
                    ->minItems(1)
                    ->maxItems(10)
                    ->required()
                    ->label('Detail Penjualan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_penjualan')->label('Kode Penjualan'),
                Tables\Columns\TextColumn::make('tanggal_penjualan')->label('Tanggal Penjualan'),
                Tables\Columns\TextColumn::make('total_harga')->label('Total Harga')
                    ->money('idr', true),
                Tables\Columns\TextColumn::make('diskon.nama_diskon')->label('Diskon'),
            ])
            ->filters([ /* Add filters if necessary */])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
