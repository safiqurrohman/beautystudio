<div>
    <div class="container">
        <div class="row">
            <h4 style="margin-top: -10px;">DATA USER</h4>
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
                <div class="card border-primary">
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
                                            <button wire:click="pilihedit({{$data->id}})"
                                                class="btn btn-warning  my-2">
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
                            <nav aria-label="Pagination">
                                <ul class="pagination">
                                   
                                    @if ($getPengguna->currentPage() > 3)
                                    <li class="page-item">
                                        <a class="page-link" wire:click="gotoPage(1)" style="cursor: pointer;">
                                            &laquo;&laquo; First
                                        </a>
                                    </li>
                                    @endif

                                    <!-- {{-- Tombol Previous --}} -->
                                    <li class="page-item {{ $getPengguna->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            &laquo; Previous
                                        </a>
                                    </li>

                                    <!-- menampilkan maksimal 3 halaman  -->
                                    @php
                                    $start = max($getPengguna->currentPage() - 2, 1);
                                    $end = min($getPengguna->currentPage() + 2, $getPengguna->lastPage());
                                    @endphp

                                    @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $page == $getPengguna->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                    </li>
                                    @endfor

                                    <!-- {{-- Tombol Next --}} -->
                                    <li class="page-item {{ !$getPengguna->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            Next &raquo;
                                        </a>
                                    </li>

                                    <!-- {{-- Tombol Last --}} -->
                                    @if ($getPengguna->currentPage() < $getPengguna->lastPage() - 2)
                                    <li class="page-item">
                                        <a class="page-link" wire:click="gotoPage({{ $$getPengguna->lastPage() }})" style="cursor: pointer;">
                                            Last &raquo;
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </nav>

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
                                <option value="">Pilih Status User</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="custemer">Pelanggan</option>
                            </select>
                            @error('role')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <button type="button" class="btn btn-secondary mt-3" wire:click='batal'>Batal</button>
                        </form>
                    </div>
                </div>
                @elseif($pilihanMenu == 'edit')
                <div class="card border-primary">
                    <div class="card-header">
                        Edit Pengguna
                    </div>
                    <div class="card-body">
                        <form wire:submit='simpanEdit'>
                            <label class="mt-2">Nama Lengkap</label>
                            <input type="text" class="form-control" wire:model='nama' placeholder="Masukkan Nama" readonly />
                            @error('nama')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Alamat Email</label>
                            <input type="email" class="form-control" wire:model='email' placeholder="Masukkan Email" readonly />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Status</label>
                            <select class="form-control" wire:model='role'>
                                <option value="">Pilih Status User</option>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="customer">Pelanggan</option>
                            </select>
                            @error('role')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <button type="button" class="btn btn-secondary mt-3" wire:click='batal'>Batal</button>
                        </form>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="batal">Batal</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal" wire:click="hapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Loading
    <div wire:ignore.self class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
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
    </div> -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('showLoading', () => {
                var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                loadingModal.show();
            });

            Livewire.on('hideLoading', () => {
                var loadingModal = bootstrap.Modal.getInstance(document.getElementById('loadingModal'));
                if (loadingModal) {
                    loadingModal.hide();
                }
            });
        });
    </script>

</div>