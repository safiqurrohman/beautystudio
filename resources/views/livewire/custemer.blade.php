<div>
    <div class="container">
        <div class="row">
            <h4 style="margin-top: -10px;">DATA CUSTOMER</h4>
            <div class="col-12 my-2">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Data Customer
                </button>
                @if(auth()->user()->role == 'karyawan')
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{$pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Tambah Customer
                </button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                <div class="card border-primary">
                    <div class="card-header">
                        Daftar Customer
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-border">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                    <th>ALamat</th>
                                    <th>Treatment</th>
                                    <th>Harga</th>
                                    <th>Karyawan</th>
                                    @if(auth()->user()->role == 'karyawan')
                                    <th>Aksi</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach ($getCustomer as $Custemer )
                                    <tr>
                                        <td>{{ ($getCustomer->currentPage() - 1) * $getCustomer->perPage() + $loop->iteration }}</td>
                                        <td>{{$Custemer->nama }}</td>
                                        <td>{{$Custemer->phone }}</td>
                                        <td>{{$Custemer->address }}</td>
                                        <td>{{$Custemer->treatment->nama }}</td>
                                        <td>Rp{{ number_format($Custemer->treatment->harga, 0, ',', '.') }}</td>
                                        <td>{{$Custemer->karyawan->name }}</td>
                                        @if(auth()->user()->role == 'karyawan')
                                        <td>
                                            <button wire:click="pilihedit({{$Custemer->id}})"
                                                class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Pagination">
                                <ul class="pagination">
                                    <li class="page-item {{ $getCustomer->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            &laquo; Previous
                                        </a>
                                    </li>
                                    @for ($page = 1; $page <= $getCustomer->lastPage(); $page++)
                                        <li class="page-item {{ $page == $getCustomer->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                        </li>
                                        @endfor
                                        <li class="page-item {{ !$getCustomer->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                                Next &raquo;
                                            </a>
                                        </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                @elseif($pilihanMenu == 'tambah' && auth()->check() && auth()->user()->role == 'karyawan')
                <div class="card border-primary">
                    <div class="card-header">
                        <h2 class="text-xl font-bold mb-4">Input Customer & Transaksi</h2>
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
</div>