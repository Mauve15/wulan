<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use Filament\Actions;
use App\Models\Barang;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PenjualanResource;

class EditPenjualan extends EditRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function afterSave(): void
    {
        $penjualan = $this->record;
        $barang = Barang::find($penjualan->barang_id);

        if ($barang) {
            // Hitung total semua quantity_jual dari penjualan untuk barang ini
            $totalPenjualan = \App\Models\Penjualan::where('barang_id', $barang->id)->sum('quantity_jual');
            // Hitung total harga
            $totalHarga = $barang->harga_satuan_barang * $totalPenjualan;
            // Update harga satuan barang
            $barang->harga_satuan_barang = $totalHarga / $totalPenjualan;


            // Update stok
            $barang->quantity_barang = $barang->pembelian->quantity_beli - $totalPenjualan;
            $barang->save();
        }
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
