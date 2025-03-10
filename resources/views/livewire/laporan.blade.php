<div>
    <div class="container-fluid">
        <div class="row">
            <h4 class="mt-2">DATA LAPORAN</h4>
            <div class="col-12 my-2">
                <button class="btn btn-primary">Data</button>
                <button class="btn btn-warning">Download</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-secondary">
                    <div class="card-header">
                        <h5 class="mb-0">Laporan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">Karyawan</th>
                                        <th class="text-center">Customer</th>
                                        <th class="text-center">Jenis Treatment</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Komisi</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getLaporan as $data)
                                    <tr>
                                        <td class="text-center">{{ ($getLaporan->currentPage() - 1) * $getLaporan->perPage() + $loop->iteration }}</td>
                                        <td>{{ $data->karyawan->name }}</td>
                                        <td>{{ $data->customer->nama }}</td>
                                        <td>{{ $data->treatment->nama }}</td>
                                        <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($data->komisi, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $data->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">{{ $data->created_at->format('F Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <nav class="mt-3">
                            <ul class="pagination justify-content-start">
                                <!-- Tombol Previous -->
                                <li class="page-item {{ $getLaporan->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">&laquo; Previous</a>
                                </li>

                                <!-- Nomor Halaman -->
                                @for ($page = 1; $page <= $getLaporan->lastPage(); $page++)
                                    <li class="page-item {{ $page == $getLaporan->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                    </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ !$getLaporan->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">Next &raquo;</a>
                                    </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>