<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use Log;
use Filament\Actions;
use App\Models\Barang;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Notifications\Notification;
use App\Filament\Resources\PembelianResource;

class EditPembelian extends EditRecord
{
    protected static string $resource = PembelianResource::class;

    protected function afterSave(): void
    {
        $pembelian = $this->record;

        $barang = Barang::where('pembelians_id', $pembelian->id)->first();

        if ($barang) {
            // Update data barang
            $barang->quantity_barang = $pembelian->quantity_beli;
            $barang->harga_barang = $pembelian->harga_satuan;
            $barang->total_harga = $pembelian->quantity_beli * $pembelian->harga_satuan;
            $barang->save();
        } else {
            // Buat baru jika belum ada
            Barang::create([
                'pembelians_id' => $pembelian->id,
                'quantity_barang' => $pembelian->quantity_beli,
                'harga_barang' => $pembelian->harga_satuan,
                'total_harga' => $pembelian->quantity_beli * $pembelian->harga_satuan,
            ]);
        }
    }



    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
