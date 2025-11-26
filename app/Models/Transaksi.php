<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode', 'total', 'status'];

    public function detilTransaksi()
    {
        return $this->hasMany(DetilTransaksi::class);
    }
}
