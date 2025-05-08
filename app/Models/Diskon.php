<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = [
        'nama_diskon',
        'persentase',
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }
}
