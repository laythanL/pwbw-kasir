<?php

namespace App\Livewire;

use App\Models\DetilTransaksi;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\Produk;
use Livewire\Component;

class Transaksi extends Component
{
    public $kode, $total, $kembalian, $totalSemuaBelanja;
    public $bayar = 0;
    public $transaksiAktif;
    public function transaksiBaru()
    {
        $this->reset();
        $this->transaksiAktif = new ModelsTransaksi();
        $this->transaksiAktif->kode = 'INV/' . date('YmdHis');
        $this->transaksiAktif->total = 0;
        $this->transaksiAktif->status = 'pending';
        $this->transaksiAktif->save();
    }


    public function hapusProduk($id)
    {
        $detil = DetilTransaksi::find($id);

        if ($detil) {
            $produk = Produk::find($detil->produk_id);
            if ($produk) {
                $produk->stok += $detil->jumlah;
                $produk->save();
            }
        }

        $detil->delete();
    }
    public function transaksiSelesai()
    {
        $this->transaksiAktif->total = $this->totalSemuaBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();

        $this->reset();
    }

    public function batalTransaksi()
    {
        if ($this->transaksiAktif) {

            $detilTransaksis = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksis as $detil) {
                $produk = Produk::find($detil->produk_id);
                if ($produk) {
                    $produk->stok += $detil->jumlah;
                    $produk->save();
                    $detil->delete();
                }
            }

            $this->transaksiAktif->delete();
        }


        $this->reset();
    }


    public function updatedKode()
    {

        $produk = Produk::where('kode', $this->kode)->first();
        if ($produk && $produk->stok > 0) {

            $detil = DetilTransaksi::firstOrNew(
                [
                    'transaksi_id' => $this->transaksiAktif->id,
                    'produk_id' => $produk->id,
                ],
                [
                    'jumlah' => 0
                ]
            );
            $detil->jumlah += 1;
            $detil->save();

            $produk->stok -= 1;
            $produk->save();

            $this->reset('kode');
        }
    }
    public function updatedBayar()
    {
        if ($this->bayar > 0) {
            $this->kembalian = $this->bayar - $this->totalSemuaBelanja;
        }
    }

    public function render()
    {
        $semuaProduk = [];
        if ($this->transaksiAktif) {
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->totalSemuaBelanja = $semuaProduk->sum(function ($detil) {
                return $detil->produk->harga * $detil->jumlah;
            });
        } else {

            $semuaProduk = [];
        }
        return view('livewire.transaksi')->with([
            'semuaProduk' => $semuaProduk
        ]);
    }
}
