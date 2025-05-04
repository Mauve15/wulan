<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PenjualanResource;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $total = 0;

        foreach ($data['detailPenjualans'] as &$detail) {
            $jumlah = (int) $detail['jumlah_beli'];
            $harga = (int) $detail['harga_jual'];
            $diskon = 0;

            if (!empty($detail['diskon_id'])) {
                $diskonModel = \App\Models\Diskon::find($detail['diskon_id']);
                $diskon = $diskonModel ? $diskonModel->jumlah_diskon : 0;
            }

            $subtotal = ($harga * $jumlah) - $diskon;
            $total += $subtotal;

            $detail['subtotal'] = $subtotal;
        }

        $data['total_harga'] = $total;

        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();

        try {
            DB::transaction(function () use ($data) {
                foreach ($data['detailPenjualans'] as $detail) {
                    DetailPenjualan::create([
                        'penjualan_id' => $this->record->id,
                        'barang_id' => $detail['barang_id'],
                        'jumlah_beli' => $detail['jumlah_beli'],
                        'harga_jual' => $detail['harga_jual'],
                        'diskon_id' => $detail['diskon_id'] ?? null,
                        'subtotal' => $detail['subtotal'],
                    ]);
                }
            });
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan detail penjualan', [
                'userId' => auth()->id(),
                'error' => $e->getMessage(),
            ]);

            Notification::make()
                ->title('Gagal menyimpan detail penjualan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
