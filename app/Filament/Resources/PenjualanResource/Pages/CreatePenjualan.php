<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use App\Models\Barang;
use App\Models\Diskon;
use App\Models\Pembelian;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PenjualanResource;
use Illuminate\Validation\ValidationException;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $pembelian = Pembelian::with('barang')->find($data['pembelian_id']);

        if (!$pembelian || !$pembelian->barang) {
            throw ValidationException::withMessages([
                'pembelian_id' => 'Pembelian atau barang terkait tidak ditemukan.',
            ]);
        }

        $hargaPerItem = $pembelian->harga_satuan;
        $subtotal = $data['quantity_jual'] * $hargaPerItem;
        $total = $subtotal * 1.20; // markup 15%

        // Cek apakah ada diskon
        if (!empty($data['diskon_id'])) {
            $diskon = Diskon::find($data['diskon_id']);
            if ($diskon) {
                $total -= ($total * ($diskon->persentase / 100));
            }
        }

        $data['total_harga_jual'] = (int) round($total);
        $data['barang_id'] = $pembelian->barang->id; // 👈 Tambahkan ini

        return $data;
    }

    protected function afterCreate(): void
    {
        $penjualan = $this->record;
        $pembelian = Pembelian::with('barang')->find($penjualan->pembelian_id);

        if (!$pembelian || !$pembelian->barang) {
            throw ValidationException::withMessages([
                'pembelian_id' => 'Barang dari pembelian tidak ditemukan.',
            ]);
        }

        $barang = $pembelian->barang;

        if ($barang->quantity_barang >= $penjualan->quantity_jual) {
            $barang->quantity_barang -= $penjualan->quantity_jual;
            $barang->save();
        } else {
            throw ValidationException::withMessages([
                'quantity_jual' => 'Stok barang tidak mencukupi.',
            ]);
        }
    }
}
