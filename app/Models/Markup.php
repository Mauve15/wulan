<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Markup extends Model
{
    //
    protected $table = 'markup';
    protected $fillable = [
        'nama_markup',
        'persentase',
        'keterangan',
    ];
}
