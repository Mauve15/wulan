<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarkupResource\Pages;
use App\Filament\Resources\MarkupResource\RelationManagers;
use App\Models\Markup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarkupResource extends Resource
{
    protected static ?string $model = Markup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('nama_markup')
                    ->label('Nama Markup')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('persentase')
                    ->label('Persentase (%)')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3)
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_markup')->label('Nama Markup'),
                Tables\Columns\TextColumn::make('persentase')->label('Persentase (%)'),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan'),
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
            'index' => Pages\ListMarkups::route('/'),
            'create' => Pages\CreateMarkup::route('/create'),
            'edit' => Pages\EditMarkup::route('/{record}/edit'),
        ];
    }
}
