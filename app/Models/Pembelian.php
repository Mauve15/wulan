<?php

namespace App\Models;

use App\Models\DetailPembelian;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = [
        'kode_pembelian',
        'kode_barang',
        'tanggal_pembelian',
        'nama_barang',
        'quantity_beli',
        'harga_satuan',
        'category_id',
        'merk',
        'status_barang'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function barang()
    {
        return $this->hasOne(Barang::class, 'pembelians_id');
    }
}
