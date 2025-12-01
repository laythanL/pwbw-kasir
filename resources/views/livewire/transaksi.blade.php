<div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark mb-0">Transaksi Kasir</h4>
                @if (!$transaksiAktif)
                    <button wire:click="transaksiBaru" class="btn btn-primary shadow-sm">
                        <i class="bi bi-plus-lg me-2"></i>Transaksi Baru
                    </button>
                @else
                    <button wire:click="batalkanTransaksi" class="btn btn-danger shadow-sm">
                        <i class="bi bi-x-circle me-2"></i>Batalkan Transaksi
                    </button>
                @endif
            </div>
        </div>

        @if ($transaksiAktif)
            <div class="row">
                <!-- Product List Section -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title fw-bold text-primary mb-0">
                                    <i class="bi bi-receipt me-2"></i>Invoice: {{ $transaksiAktif->kode }}
                                </h5>
                                <span class="badge bg-light text-primary border border-primary">Active</span>
                            </div>

                            <div class="input-group mb-4 shadow-sm">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-upc-scan text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0"
                                    placeholder="Scan Barcode / Input Kode Produk..." wire:model.live="kode" autofocus>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="py-3 ps-3 rounded-start">No</th>
                                            <th class="py-3">Kode</th>
                                            <th class="py-3">Nama Barang</th>
                                            <th class="py-3">Harga</th>
                                            <th class="py-3 text-center">Qty</th>
                                            <th class="py-3">Total</th>
                                            <th class="py-3 pe-3 rounded-end text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semuaProduk as $produk)
                                            <tr>
                                                <td class="ps-3">{{ $loop->iteration }}</td>
                                                <td><span
                                                        class="badge bg-light text-dark border">{{ $produk->produk->kode }}</span>
                                                </td>
                                                <td class="fw-medium">{{ $produk->produk->nama }}</td>
                                                <td>Rp {{ number_format($produk->produk->harga, 0, ',', '.') }}</td>
                                                <td class="text-center">{{ $produk->jumlah }}</td>
                                                <td class="fw-bold text-primary">Rp
                                                    {{ number_format($produk->harga * $produk->jumlah, 0, ',', '.') }}</td>
                                                <td class="text-center pe-3">
                                                    <button wire:click="hapusProduk({{ $produk->id }})"
                                                        class="btn btn-light text-danger btn-sm border-0" title="Hapus Item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if($semuaProduk->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-muted">
                                                    <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                                                    Belum ada produk yang ditambahkan
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 bg-primary text-white mb-3">
                        <div class="card-body p-4">
                            <h6 class="text-uppercase opacity-75 mb-2">Total Tagihan</h6>
                            <h1 class="fw-bold mb-0 display-5">Rp {{ number_format($totalSemuaBelanja, 0, ',', '.') }}</h1>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body p-4">
                            <label class="form-label fw-bold text-muted text-uppercase small">Pembayaran</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light border-end-0 fw-bold">Rp</span>
                                <input type="number" class="form-control border-start-0 fs-5 fw-bold" placeholder="0"
                                    wire:model.live="bayar">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                                <span class="text-muted fw-medium">Kembalian</span>
                                <span class="fw-bold fs-5 {{ $kembalian < 0 ? 'text-danger' : 'text-success' }}">
                                    Rp {{ number_format($kembalian, 0, ',', '.') }}
                                </span>
                            </div>

                            @if ($bayar)
                                @if ($kembalian < 0)
                                    <div class="alert alert-danger border-0 d-flex align-items-center" role="alert">
                                        <i class="bi bi-exclamation-circle-fill me-2"></i> Uang Kurang
                                    </div>
                                @elseif ($kembalian >= 0)
                                    <button class="btn btn-success w-100 py-3 fw-bold shadow-sm" wire:click="transaksiSelesai">
                                        <i class="bi bi-check-circle-fill me-2"></i> SELESAIKAN TRANSAKSI
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <div class="py-5">
                        <i class="bi bi-shop fs-1 text-muted mb-3 d-block" style="font-size: 4rem !important;"></i>
                        <h3 class="text-muted">Siap Melayani Pelanggan</h3>
                        <p class="text-muted mb-4">Silahkan klik tombol "Transaksi Baru" untuk memulai.</p>
                        <button wire:click="transaksiBaru" class="btn btn-primary btn-lg px-5 shadow-sm">
                            <i class="bi bi-plus-lg me-2"></i>Transaksi Baru
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>