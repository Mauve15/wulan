<?php

namespace App\Filament\Resources\BarangResource\Pages;

use Filament\Actions;
use App\Models\Pembelian;
use App\Filament\Resources\BarangResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Pastikan pembelians_id ada
        if (empty($data['pembelians_id'])) {
            return $data; // atau bisa menambahkan logika jika pembelians_id wajib
        }

        // Cari pembelian yang terkait berdasarkan pembelians_id
        $pembelian = Pembelian::find($data['pembelians_id']);

        if ($pembelian) {
            // Pastikan quantity_barang dan harga_satuan valid
            $quantity = is_numeric($data['quantity_barang']) ? (int) $data['quantity_barang'] : 0;
            $hargaSatuan = is_numeric($pembelian->harga_satuan) ? (int) $pembelian->harga_satuan : 0;

            // Menghitung total_harga
            $data['total_harga'] = $quantity * $hargaSatuan;
        }
        return $data;
    }
}
