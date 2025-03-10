<div>
    <div class="container">
        <div class="row">
            <h4 style="margin-top: -10px;">DATA TREATMENT</h4>
            <div class="col-12 my-2">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Data
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{$pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Tambah Treatment
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                <div class="card border-primary">
                    <div class="card-header">
                        Daftar Treatment
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
                                    @foreach ($getTreatment as $treatment )
                                    <tr>
                                        <td>{{ ($getTreatment->currentPage() - 1) * $getTreatment->perPage() + $loop->iteration }}</td>
                                        <td>{{$treatment->nama }}</td>
                                        <td>{{$treatment->kategori }}</td>
                                        <td>Rp{{number_format($treatment->harga, 0, ',', '.')}}</td>
                                        <td>
                                            <button wire:click="pilihedit({{$treatment->id}})"
                                                class="btn btn-warning my-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button wire:click="pilihhapus({{$treatment->id}})"
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
                                    <!-- Tombol Previous -->
                                    <li class="page-item {{ $getTreatment->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            &laquo; Previous
                                        </a>
                                    </li>

                                    <!-- Nomor Halaman -->
                                    @for ($page = 1; $page <= $getTreatment->lastPage(); $page++)
                                    <li class="page-item {{ $page == $getTreatment->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                    </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ !$getTreatment->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            Next &raquo;
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                @elseif($pilihanMenu == 'tambah')
                <div class="card border-primary">
                    <div class="card-header">
                        <form wire:submit='simpan'>
                            <label class="mt-2">Nama Treatment</label>
                            <input type="text" class="form-control" wire:model='nama' placeholder="Masukkan Nama Treatment" />
                            @error('nama')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Kategori</label>
                            <input type="text" class="form-control" wire:model='kategori' placeholder="Masukkan Kategori" />
                            @error('kategori')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Harga</label>
                            <input type="text" class="form-control" wire:model='harga' placeholder="Masukkan Harga" />
                            @error('harga')
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
                        Edit Layanan
                    </div>
                    <div class="card-body">
                        <form wire:submit='simpanEdit'>
                            <label class="mt-2">Nama Treatment</label>
                            <input type="text" class="form-control" wire:model='nama' placeholder="Masukkan Nama Treatment" />
                            @error('nama')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Kategori</label>
                            <input type="text" class="form-control" wire:model='kategori' placeholder="Masukkan Kategori" />
                            @error('kategori')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <br>
                            <label class="mt-2">Harga</label>
                            <input type="text" class="form-control" wire:model='harga' placeholder="Masukkan Harga" />
                            @error('kategori')
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
                    Apakah Anda yakin ingin menghapus <strong>{{$piltretament->nama ?? ''}}</strong>?
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

    <!-- Script untuk menutup modal setelah hapus/batal -->
    <!-- <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('tutupModal', () => {
                var hapusModal = bootstrap.Modal.getInstance(document.getElementById('hapusModal'));
                if (hapusModal) {
                    hapusModal.hide();
                }
            });
        });
    </script> -->

</div>