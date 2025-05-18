<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembelian extends Model
{
    protected $fillable = [
        'no_invoice',
        'no_faktur',
        'tanggal_pembelian',
        'nama_barang',
        'quantity_beli',
        'harga_satuan',
        'total_harga_beli',
        'nama_supplier',
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
