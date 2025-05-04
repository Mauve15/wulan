<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_penjualan',
        'tanggal_penjualan',
        'total_harga',
        'diskon_id'
    ];

    // Relasi dengan Diskon
    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }

    // Relasi dengan DetailPenjualan
    // app/Models/Penjualan.php
    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }


    // Menghitung total harga dari penjualan setelah diskon per barang dan diskon global

}
