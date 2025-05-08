<?php

namespace App\Filament\Resources;

use App\Models\Penjualan;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\PenjualanResource\Pages;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([

            DatePicker::make('tanggal_penjualan')
                ->label('Tanggal Penjualan')
                ->required(),

            TextInput::make('quantity_jual')
                ->label('Jumlah Jual')
                ->numeric()
                ->required(),

            Select::make('pembelian_id')
                ->label('Pembelian')
                ->relationship('pembelian', 'nama_barang')
                ->searchable()
                ->required(),


            Select::make('diskon_id')
                ->label('Diskon (Opsional)')
                ->relationship('diskon', 'nama_diskon')
                ->searchable()
                ->nullable(),

            TextInput::make('total_harga_jual')
                ->label('Total Harga (Otomatis)')
                ->numeric()
                ->readOnly()
                ->disabled(), // agar tidak bisa diubah manual di form
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('tanggal_penjualan')->date()->label('Tanggal'),
            Tables\Columns\TextColumn::make('quantity_jual')->label('Qty'),
            Tables\Columns\TextColumn::make('pembelian.nama_barang')->label('Barang'), // Gunakan metode namaBarang() untuk mendapatkan nama_barang->label('Barang'),

            Tables\Columns\TextColumn::make('diskon.nama_diskon')->label('Diskon')->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('total_harga_jual')->label('Total Harga')->money('IDR'),
        ])
            ->filters([])
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
        return [];
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
