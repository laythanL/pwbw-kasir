<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
       protected $fillable = [
        'kode',
        'nama',
        'harga',
        'stok'
    ];
}
