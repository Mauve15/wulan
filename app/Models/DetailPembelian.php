<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $fillable = [
        'pembelian_id',
        'barang_id',
        'jumlah_pembelian',
        'harga_pembelian',
        'total_harga',
        'diskon_id'
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }
}
