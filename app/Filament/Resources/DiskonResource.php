<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiskonResource\Pages;
use App\Filament\Resources\DiskonResource\RelationManagers;
use App\Models\Diskon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiskonResource extends Resource
{
    protected static ?string $model = Diskon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_diskon')
                    ->label('Kode Diskon')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('nama_diskon')
                    ->label('Nama Diskon')
                    ->required(),

                Forms\Components\TextInput::make('jumlah_diskon')
                    ->label('Jumlah Diskon')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('satuan_diskon')
                    ->label('Satuan Diskon')
                    ->options([
                        'persen' => 'Persen (%)',
                        'nominal' => 'Nominal (Rp)',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('keterangan_diskon')
                    ->label('Keterangan')
                    ->rows(3)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_diskon')->label('Kode')->searchable(),
                Tables\Columns\TextColumn::make('nama_diskon')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('jumlah_diskon')
                    ->label('Jumlah')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->satuan_diskon === 'persen') {
                            return $state . '%';
                        } elseif ($record->satuan_diskon === 'nominal') {
                            return 'Rp ' . number_format($state, 0, ',', '.');
                        }
                        return $state;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('satuan_diskon')->label('Satuan')->sortable(),
                Tables\Columns\TextColumn::make('keterangan_diskon')->label('Keterangan')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
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
            'index' => Pages\ListDiskons::route('/'),
            'create' => Pages\CreateDiskon::route('/create'),
            'edit' => Pages\EditDiskon::route('/{record}/edit'),
        ];
    }
}
