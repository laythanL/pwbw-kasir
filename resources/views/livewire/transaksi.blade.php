<div>
    <div class="container">
        <div class="row mt-2">

            @if (!$transaksiAktif)
                <button wire:click="transaksiBaru" class="btn btn-primary">Transaksi Baru</button>
            @else
                <button wire:click="batalkanTransaksi" class="btn btn-primary">Batalkan Transaksi</button>
            @endif

            <button wire:loading class="btn btn-info">Loading ...</button>

        </div>
    </div>

    @if ($transaksiAktif)
        <div class="row mt-2">
            <div class="col-8">
                <div class="card border-primary">
                    <div class="card-body">

                        <h4 class="card-title">
                            No Invoice : {{ $transaksiAktif->kode }}
                        </h4>

                        <input type="text" class="form-control mb-2"
                               placeholder="No invoice" wire:model="kode">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->produk->kode }}</td>
                                        <td>{{ $produk->produk->nama }}</td>
                                        <td>{{ number_format($produk->produk->harga, 2, '', '') }}</td>
                                        <td>{{ $produk->jumlah }}</td>
                                        <td>{{ number_format($produk->harga * $produk->jumlah, 2, '', '') }}</td>
                                        <td>
                                            <button wire:click="hapusProduk({{ $produk->id }})"
                                                    class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            {{-- ====================== SIDE PANEL ====================== --}}
            <div class="col-4">

                {{-- TOTAL --}}
                <div class="card border-primary">
                    <div class="card-body">
                        <h4 class="card-title">Total Bayar</h4>
                        <div class="d-flex justify-content-between">
                            <span>Rp.</span>
                            <span>{{ number_format($totalSemuaBelanja, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- INPUT BAYAR --}}
                <div class="card border-primary mt-2">
                    <div class="card-body">
                        <h4 class="card-title">Bayar</h4>
                        <input type="number" class="form-control" placeholder="Bayar"
                               wire:model.live="bayar">
                    </div>
                </div>

                {{-- KEMBALIAN --}}
                <div class="card border-primary mt-2">
                    <div class="card-body">
                        <h4 class="card-title">Kembalian</h4>
                        <div class="d-flex justify-content-between">
                            <span>Rp.</span>
                            <span>{{ number_format($kembalian, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- VALIDASI PEMBAYARAN --}}
                @if ($bayar)
                    @if ($kembalian < 0)
                        <div class="alert alert-danger mt-2" role="alert">
                            Uang kurang
                        </div>
                    @elseif ($kembalian > 0)
                        <button class="btn btn-success mt-2 w-100"
                                wire:click="transaksiSelesai">
                            Bayar
                        </button>
                    @endif
                @endif

            </div>
        </div>
    @endif

</div>
