<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianResource\Pages;
use App\Filament\Resources\PembelianResource\RelationManagers;
use App\Models\Pembelian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_invoice')->required(),
                Forms\Components\TextInput::make('no_faktur')->required(),
                Forms\Components\DatePicker::make('tanggal_pembelian')->required(),
                Forms\Components\TextInput::make('nama_barang')->required(),
                Forms\Components\TextInput::make('quantity_beli')->required()->numeric(),
                // Forms\Components\TextInput::make('total_harga_beli')
                //     ->numeric()
                //     ->hidden(), // sembunyikan dari form, tapi tetap terdaftar

                Forms\Components\TextInput::make('harga_satuan')->required()->numeric(),
                Forms\Components\TextInput::make('nama_supplier')->required(),
                Forms\Components\Select::make('category_id')->relationship('category', 'nama_kategori')->required(),
                Forms\Components\TextInput::make('merk')->required(),
                // Forms\Components\TextInput::make('status_barang')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_pembelian')->date(),
                Tables\Columns\TextColumn::make('nama_barang'),
                Tables\Columns\TextColumn::make('quantity_beli'),
                Tables\Columns\TextColumn::make('harga_satuan')->money('IDR'),
                Tables\Columns\TextColumn::make('total_harga_beli')->money('IDR'),
                // Tables\Columns\TextColumn::make('status_barang'),
                Tables\Columns\TextColumn::make('no_invoice'),
                Tables\Columns\TextColumn::make('no_faktur'),
                Tables\Columns\TextColumn::make('nama_supplier')->label('Supplier'),
                Tables\Columns\TextColumn::make('merk'),
                Tables\Columns\TextColumn::make('category.nama_kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
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
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
