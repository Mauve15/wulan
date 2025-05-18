<?php

namespace App\Filament\Resources\BarangResource\Pages;

use Filament\Actions;
use App\Models\Pembelian;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BarangResource;

class EditBarang extends EditRecord
{
    protected static string $resource = BarangResource::class;
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $pembelian = Pembelian::find($data['pembelians_id']);

        if ($pembelian) {
            $data['total_harga'] = $data['quantity_barang'] * (int)$pembelian->harga_satuan;
        }

        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
