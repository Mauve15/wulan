<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = [
        'kode_diskon',
        'nama_diskon',
        'jumlah_diskon',
        'satuan_diskon',
        'keterangan_diskon'
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
