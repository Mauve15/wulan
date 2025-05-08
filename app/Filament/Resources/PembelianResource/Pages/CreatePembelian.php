<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use Filament\Actions;
use App\Models\Barang;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PembelianResource;

class CreatePembelian extends CreateRecord
{
    protected static string $resource = PembelianResource::class;
    protected function afterCreate(): void
    {
        $pembelian = $this->record;

        Barang::create([
            'pembelians_id' => $pembelian->id,
            'quantity_barang' => $pembelian->quantity_beli,
            'harga_barang'      => $pembelian->harga_satuan,
            'total_harga'       => $pembelian->quantity_beli * $pembelian->harga_satuan,
        ]);
    }
}
