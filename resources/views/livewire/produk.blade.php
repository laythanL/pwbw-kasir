<div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Manajemen Produk</h4>
                    <p class="text-muted mb-0">Kelola data produk dan stok barang.</p>
                </div>
                <div>
                    <button wire:click="pilihMenu('lihat')"
                        class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-light text-primary' }} shadow-sm me-2">
                        <i class="bi bi-list-ul me-2"></i>Semua Produk
                    </button>
                    <button wire:click="pilihMenu('tambah')"
                        class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-light text-primary' }} shadow-sm">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Produk
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="py-3 ps-4 rounded-start">No</th>
                                            <th class="py-3">Kode</th>
                                            <th class="py-3">Nama</th>
                                            <th class="py-3">Harga</th>
                                            <th class="py-3">Stok</th>
                                            <th class="py-3 pe-4 rounded-end text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($semuaProduk as $produk)
                                            <tr>
                                                <td class="ps-4">{{ $loop->iteration }}</td>
                                                <td><span class="badge bg-light text-dark border">{{ $produk->kode }}</span>
                                                </td>
                                                <td class="fw-medium">{{ $produk->nama }}</td>
                                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $produk->stok > 10 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $produk->stok > 10 ? 'success' : 'danger' }} border border-{{ $produk->stok > 10 ? 'success' : 'danger' }}">
                                                        {{ $produk->stok }}
                                                    </span>
                                                </td>
                                                <td class="text-center pe-4">
                                                    <button wire:click="pilihEdit({{ $produk->id }})"
                                                        class="btn btn-light text-primary btn-sm border-0 me-1"
                                                        title="Edit Produk">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                        </svg>
                                                    </button>
                                                    <button wire:click="pilihHapus({{ $produk->id }})"
                                                        class="btn btn-light text-danger btn-sm border-0" title="Hapus Produk">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                @elseif($pilihanMenu == 'tambah')
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-primary">Tambah Produk Baru</h5>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="simpan">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Kode Produk</label>
                                        <input type="text" class="form-control" wire:model="kode"
                                            placeholder="Contoh: BRG001">
                                        @error('kode') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Nama Produk</label>
                                        <input type="text" class="form-control" wire:model="nama" placeholder="Nama Barang">
                                        @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Harga Satuan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" wire:model="harga" placeholder="0">
                                        </div>
                                        @error('harga') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Stok Awal</label>
                                        <input type="number" class="form-control" wire:model="stok" placeholder="0">
                                        @error('stok') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-save me-2"></i>Simpan Produk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                @elseif($pilihanMenu == 'edit')
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-primary">Edit Data Produk</h5>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="simpanEdit">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Kode Produk</label>
                                        <input type="text" class="form-control" wire:model="kode">
                                        @error('kode') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Nama Produk</label>
                                        <input type="text" class="form-control" wire:model="nama">
                                        @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Harga Satuan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" wire:model="harga">
                                        </div>
                                        @error('harga') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-medium">Stok</label>
                                        <input type="number" class="form-control" wire:model="stok">
                                        @error('stok') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <button type="button" wire:click="batal" class="btn btn-light">Batal</button>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                @elseif($pilihanMenu == 'hapus')
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-danger text-white py-3">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                            </h5>
                        </div>
                        <div class="card-body p-4 text-center">
                            <p class="mb-4">Apakah Anda yakin ingin menghapus produk ini secara permanen?</p>
                            <div class="alert alert-light border d-inline-block text-start mb-4 px-5">
                                <p class="mb-1"><strong>Kode:</strong> {{ $produkTerpilih->kode }}</p>
                                <p class="mb-0"><strong>Nama:</strong> {{ $produkTerpilih->nama }}</p>
                            </div>
                            <div class="d-flex justify-content-center gap-2">
                                <button wire:click="batal" class="btn btn-light px-4">Batal</button>
                                <button wire:click="hapus" class="btn btn-danger px-4">
                                    <i class="bi bi-trash me-2"></i>Ya, Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>