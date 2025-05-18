<?php

namespace App\Filament\Resources\MarkupResource\Pages;

use App\Filament\Resources\MarkupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarkup extends EditRecord
{
    protected static string $resource = MarkupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
