<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // penting karena tabel kamu 'barang', bukan 'barangs'

    protected $fillable = [
        'pembelians_id',
        'penjualans_id',
        'nama_barang',
        'quantity_barang',
        'total_harga',
    ];
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelians_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualans_id');
    }
}
