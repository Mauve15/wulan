<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // penting karena tabel kamu 'barang', bukan 'barangs'

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'category_id',
        'merk',
        'harga_jual',
        'satuan_barang',
        'stock',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
