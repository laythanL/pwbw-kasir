<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Livewire\Component;

class Beranda extends Component
{
    public function render()
    {
        $totalUsers = User::count();
        $totalProducts = Produk::count();
        $totalTransactions = Transaksi::where('status', 'selesai')->count();
        $totalStock = Produk::sum('stok');

        return view('livewire.beranda')->with([
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalTransactions' => $totalTransactions,
            'totalStock' => $totalStock
        ]);
    }
}
