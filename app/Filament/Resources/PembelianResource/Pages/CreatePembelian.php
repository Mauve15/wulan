<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use Filament\Actions;
use App\Models\Barang;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PembelianResource;

class CreatePembelian extends CreateRecord
{
    protected static string $resource = PembelianResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $quantity = is_numeric($data['quantity_beli']) ? (int) $data['quantity_beli'] : 0;
        $harga = is_numeric($data['harga_satuan']) ? (int) $data['harga_satuan'] : 0;

        $data['total_harga_beli'] = $quantity * $harga;

        return $data;
    }
    protected function afterCreate(): void
    {
        // Ambil data pembelian yang baru dibuat
        $pembelian = $this->record;

        // Simpan data ke tabel barang
        Barang::create([
            'pembelians_id' => $pembelian->id,
            // 'nama_barang' => $pembelian->nama_barang,
            'quantity_barang' => $pembelian->quantity_beli ?? 0,
            'total_harga' => $pembelian->total_harga_beli ?? 0,
            'penjualans_id' => null,
        ]);
    }
}
