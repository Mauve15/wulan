<?php

namespace App\Filament\Resources;

use App\Models\Diskon;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class DiskonResource extends Resource
{
    protected static ?string $model = Diskon::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Diskon';
    protected static ?string $navigationGroup = 'Penjualan';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nama_diskon')
                    ->required()
                    ->minLength(3)
                    ->maxLength(50)
                    ->label('Nama Diskon'),

                TextInput::make('persentase')
                    ->required()
                    ->label('Persentase Diskon')
                    ->numeric() // Validasi hanya angka
                    ->helperText('Masukkan persentase dalam angka (misal: 10 untuk 10%)')
                    ->reactive()
                    ->rules('min:0|max:100'), // Validasi persentase antara 0 dan 100
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_diskon')->sortable()->searchable(),
                TextColumn::make('persentase')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 2) . '%'), // Format persentase
                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\DiskonResource\Pages\ListDiskons::route('/'),
            'create' => \App\Filament\Resources\DiskonResource\Pages\CreateDiskon::route('/create'),
            'edit' => \App\Filament\Resources\DiskonResource\Pages\EditDiskon::route('/{record}/edit'),
        ];
    }
}
