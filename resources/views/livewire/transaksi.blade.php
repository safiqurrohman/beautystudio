<div>
    <div class="container">
        <div class="row">
            <h4 style="margin-top: -10px;">DATA TRANSAKSI</h4>
            <div class="col-12 my-2">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Data
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu=='tambah' ? 'btn-success' : 'btn-outline-success'}}">
                    Transaksi
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
                                    <th>Tgl Daftar</th>
                                    <th>Tgl Update</th>
                                    <th>Karyawan</th>
                                    <th>Treatment</th>
                                    <th>Customer</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($getTransaksi as $data )
                                    <tr>
                                        <td>{{ ($getTransaksi->currentPage() - 1) * $getTransaksi->perPage() + $loop->iteration }}</td>
                                        <td>{{$data->created_at->format('d-m-Y')}}</td>
                                        <td>{{$data->updated_at->format('d-m-Y')}}</td>
                                        <td>{{$data->karyawan->name }}</td>
                                        <td>{{$data->treatment->nama }}</td>
                                        <td>{{$data->customer->nama }}</td>
                                        <td>Rp {{number_format($data->treatment->harga, 0, ',',  '.')}}</td>
                                        <td>
                                            <button wire:click="pilihedit({{$data->id}})"
                                                class="btn btn-warning ">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Pagination">
                                <ul class="pagination">
                                    <!-- {{-- Tombol First --}} -->
                                    @if ($getTransaksi->currentPage() > 3)
                                    <li class="page-item">
                                        <a class="page-link" wire:click="gotoPage(1)" style="cursor: pointer;">
                                            &laquo; First
                                        </a>
                                    </li>
                                    @endif

                                    <!-- {{-- Tombol Previous --}} -->
                                    <li class="page-item {{ $getTransaksi->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            &laquo; Previous
                                        </a>
                                    </li>

                                    <!-- menampilkan maksimal 3 halaman -->
                                    @php
                                    $start = max($getTransaksi->currentPage() - 2, 1);
                                    $end = min($getTransaksi->currentPage() + 2, $getTransaksi->lastPage());
                                    @endphp

                                    @for ($page = $start; $page <= $end; $page++)
                                        <li class="page-item {{ $page == $getTransaksi->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                        </li>
                                        @endfor

                                        <!-- {{-- Tombol Next --}} -->
                                        <li class="page-item {{ !$getTransaksi->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                                Next &raquo;
                                            </a>
                                        </li>

                                        <!-- {{-- Tombol Last --}} -->
                                        @if ($getTransaksi->currentPage() < $getTransaksi->lastPage() - 2)
                                            <li class="page-item">
                                                <a class="page-link" wire:click="gotoPage({{ $getTransaksi->lastPage() }})" style="cursor: pointer;">
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
                        <h2 class="text-xl font-bold mb-4">Lakukan Transaksi</h2>
                        @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                        @endif
                        @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="simpan">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" wire:model="nama" placeholder="Masukkan Nama Lengkap">
                                        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No HP</label>
                                        <input type="text" class="form-control" wire:model="phone" placeholder="Masukkan No HP">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" wire:model="address" placeholder="Masukkan Alamat">
                                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Treatment</label>
                                        <select wire:model="id_treatment" class="form-select">
                                            <option value="">Pilih Treatment</option>
                                            @foreach($getTreatment as $t)
                                            <option value="{{ $t->id }}">{{ $t->nama }} - Rp{{ number_format($t->harga, 0, ',', '.') }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_treatment') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Karyawan</label>
                                        <select wire:model="id_karyawan" class="form-select">
                                            <option value="">Pilih Karyawan</option>
                                            @foreach($getKaryawan as $k)
                                            @if($k->role == 'karyawan')
                                            <option value="{{ $k->id }}">{{ $k->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('id_karyawan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Bayar</label>
                                        <input type="number" class="form-control" wire:model="bayar">
                                        @error('bayar') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan di Kanan Bawah -->
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
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