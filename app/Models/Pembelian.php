<?php

namespace App\Models;

use App\Models\DetailPembelian;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = [
        'kode_pembelian',
        'kode_supplier',
        'nama_supplier',
        'tanggal_pembelian',
        'total_harga',
        'diskon_id'
    ];

    public function diskon()
    {
        return $this->belongsTo(Diskon::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
