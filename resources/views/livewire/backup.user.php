<div>
    <div class="container">
        <div class="row">
            <div class="col-12 my-2">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Data User
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{$pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Tambah Data
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                <div class="card border-light">
                    <div class="card-header">
                        Daftar User
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-border">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($getPengguna as $data )
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>{{$data->name }}</td>
                                        <td>{{$data->email }}</td>
                                        <td>{{$data->role }}</td>
                                        <td>
                                            <button wire:click="pilihMenu('edit')"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button wire:click="pilihhapus({{$data->id}})"
                                                class="btn btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#hapusModal">
                                                <i class="bi bi-trash3-fill"></i>
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
                <div class="card border-primary">
                    <div class="card-header">
                        <form wire:submit='simpan'>
                            <label class="mt-2">Nama Lengkap</label>
                            <input type="text" class="form-control" wire:model='nama' placeholder="Masukkan Nama" />
                            @error('nama')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Alamat Email</label>
                            <input type="email" class="form-control" wire:model='email' placeholder="Masukkan Email" />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Password</label>
                            <input type="text" class="form-control" wire:model='password' placeholder="Masukkan Password" />
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Status</label>
                            <select class="form-control" wire:model='role'>
                                <option value="admin">Pilih Status User</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                            @error('role')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>

                        </form>
                    </div>

                </div>
                @elseif($pilihanMenu == 'edit')
                @elseif($pilihanMenu == 'hapus')
                <div class="card border-danger">
                    <div class="card-header">
                        Hapus Pengguna
                    </div>
                    <div class="card-body bg-danger text-white">
                        Apakah Anda yakin untuk menghapus {{$pilpengguna->name}} ?
                        <div class="card">
                            <button class="btn btn danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn sencondary" wire:click='batal'>Batal</button>
                        </div>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


    <!-- Modal Konfirmasi Hapus -->
    <div wire:ignore.self class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <strong>{{$pilpengguna->name ?? ''}}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="hapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Loading -->
    <div wire:loading wire:target="pilihMenu">
        <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Mohon Tunggu...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus Modal Saat Loading Selesai -->
    <div wire:loading.remove wire:target="pilihMenu">
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.hook('message.processed', (message, component) => {
                    document.querySelectorAll('.modal').forEach(modal => modal.style.display = 'none');
                });
            });
        </script>
    </div>
</div>