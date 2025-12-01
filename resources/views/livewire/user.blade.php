<div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Manajemen Pengguna</h4>
                    <p class="text-muted mb-0">Kelola data pengguna aplikasi.</p>
                </div>
                <div>
                    <button wire:click="pilihMenu('lihat')"
                        class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-light text-primary' }} shadow-sm me-2">
                        <i class="bi bi-list-ul me-2"></i>Semua Pengguna
                    </button>
                    <button wire:click="pilihMenu('tambah')"
                        class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-light text-primary' }} shadow-sm">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Pengguna
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
                                            <th class="py-3">Nama</th>
                                            <th class="py-3">Email</th>
                                            <th class="py-3">Peran</th>
                                            <th class="py-3 pe-4 rounded-end text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($semuaPengguna as $pengguna)
                                            <tr>
                                                <td class="ps-4">{{ $loop->iteration }}</td>
                                                <td class="fw-medium">{{ $pengguna->name }}</td>
                                                <td>{{ $pengguna->email }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $pengguna->peran == 'admin' ? 'bg-primary' : 'bg-info' }} bg-opacity-10 text-{{ $pengguna->peran == 'admin' ? 'primary' : 'info' }} border border-{{ $pengguna->peran == 'admin' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($pengguna->peran) }}
                                                    </span>
                                                </td>
                                                <td class="text-center pe-4">
                                                    <button wire:click="pilihEdit({{ $pengguna->id }})"
                                                        class="btn btn-light text-primary btn-sm border-0 me-1"
                                                        title="Edit Pengguna">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                        </svg>
                                                    </button>
                                                    <button wire:click="pilihHapus({{ $pengguna->id }})"
                                                        class="btn btn-light text-danger btn-sm border-0"
                                                        title="Hapus Pengguna">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
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
                            <h5 class="mb-0 fw-bold text-primary">Tambah Pengguna Baru</h5>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="simpan">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nama Lengkap</label>
                                    <input type="text" class="form-control" wire:model="nama"
                                        placeholder="Masukkan nama lengkap">
                                    @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Email Address</label>
                                    <input type="email" class="form-control" wire:model="email"
                                        placeholder="name@example.com">
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Password</label>
                                    <input type="password" class="form-control" wire:model="password"
                                        placeholder="Minimal 8 karakter">
                                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">Peran</label>
                                    <select class="form-select" wire:model="peran">
                                        <option value="">-- Pilih Peran --</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                                    @error('peran') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-save me-2"></i>Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                @elseif($pilihanMenu == 'edit')
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold text-primary">Edit Data Pengguna</h5>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="simpanEdit">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Nama Lengkap</label>
                                    <input type="text" class="form-control" wire:model="nama">
                                    @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Email Address</label>
                                    <input type="email" class="form-control" wire:model="email">
                                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-medium">Password (Opsional)</label>
                                    <input type="text" class="form-control" wire:model="Password"
                                        placeholder="Kosongkan jika tidak ingin mengubah">
                                    @error('Password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">Peran</label>
                                    <select class="form-select" wire:model="peran">
                                        <option value="">-- Pilih Peran --</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>
                                    @error('peran') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2">
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
                            <p class="mb-4">Apakah Anda yakin ingin menghapus pengguna ini secara permanen?</p>
                            <div class="alert alert-light border d-inline-block text-start mb-4 px-5">
                                <p class="mb-1"><strong>Nama:</strong> {{ $penggunaTerpilih->name }}</p>
                                <p class="mb-0"><strong>Email:</strong> {{ $penggunaTerpilih->email }}</p>
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