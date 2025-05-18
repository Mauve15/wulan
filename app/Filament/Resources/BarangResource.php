<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Models\Barang;
use App\Models\Category;  // pastikan untuk meng-import model Category
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_barang')
                    ->required()
                    ->unique()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(255),

                // Input untuk jenis_barang
                Forms\Components\TextInput::make('jenis_barang')
                    ->required()
                    ->maxLength(255),

                // Dropdown untuk category_id (relasi ke tabel categories)
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('nama_kategori', 'id'))
                    ->required(),

                // Input untuk merk
                Forms\Components\TextInput::make('merk')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('harga_barang')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->disabled(), // atau readonly() jika kamu tidak ingin diubah

                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->numeric()
                    ->disabled(), // atau readonly()

                // Input untuk stock
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pembelian.no_invoice')->label('No Invoice')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pembelian.nama_barang')->label('Nama Barang')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity_barang')->label('Stok')->sortable(),
                Tables\Columns\TextColumn::make('pembelian.harga_satuan')->label('Harga Satuan')->sortable()->money('IDR'),
                Tables\Columns\TextColumn::make('total_harga')->label('Total Harga')->sortable()->money('IDR'),
                Tables\Columns\TextColumn::make('pembelian.category.nama_kategori')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('pembelian.merk')->label('Merk')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Dibuat')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Diperbarui')->sortable(),

            ])
            ->filters([ /* Filter jika diperlukan */])
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
            // Anda bisa menambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
