<div>
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua Pengguna
                </button>

                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Tambah Pengguna
                </button>

                <button wire:loading class="btn btn-info">
                    Loading ...
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                    <div class="card border-primary">
                        <div class="card-header">
                            Semua Pengguna
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                              <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>data</th> 
                              </thead>
                              <tbody>
                                @foreach($semuaPengguna as $pengguna)
                                <tr>
                                    <td>{{ $loop ->iteration}}</td>
                                    <td>{{ $pengguna->nama }}</td>
                                    <td>{{ $pengguna->email }}</td>
                                    <td>{{ $pengguna->peran }}</td>
                             
                                    <td>
                                         <button wire:click="pilihMenu('edit')"
                                          class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                          Edit pengguna
                                          </button>
                                              <button wire:click="pilihMenu('hapus')"
                                            class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                            Hapus Pengguna
                                            </button>
                                    </td>
              
                                      
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>

                @elseif($pilihanMenu == 'tambah')
                <div class="card border-primary">
                    <div class="card-header">
                        Tambah Pengguna
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="simpan">
                          <label>Nama</label>
                          <input type="text" class="form-control" wire:model="nama">
                          @error('nama')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror

                          <label>Email</label>
                          <input type="text" class="form-control" wire:model="email">
                          @error('email')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror

                          <label>Password</label>
                          <input type="password" class="form-control" wire:model="password">
                          @error('password')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror

                          <label>Peran</label>
                          <select class="form-control" wire:model="peran">
                              <option value="">--Pilih Peran--</option>
                              <option value="admin">Admin</option>
                              <option value="kasir">Kasir</option>
                          </select>
                          @error('peran')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        
                          <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </form>
                    </div>
                </div>
                @elseif($pilihanMenu == 'edit')
                @elseif($pilihanMenu == 'hapus')
                @endif
            </div>
        </div>
    </div>
</div>
