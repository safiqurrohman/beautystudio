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
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="col-md-12 col">
                            <div class="col-md-12">
                                <h5 class="mb-0 text-white" style="font-size: 25px;">Laporan</h5>
                            </div>
                            <div class="col-md-12 text-end">
                                <!-- Pilihan Tahun -->
                                <select class="form-control d-inline w-25" wire:model="selectedYear">
                                    <option value="">Pilih Tahun</option>
                                    @foreach($years as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                    @endforeach
                                </select>
                                <!-- Pilihan Bulan -->
                                <select class="form-control d-inline w-25" wire:model="selectedMonth">
                                    <option value="">Pilih Bulan</option>
                                    @foreach($months as $month)
                                    <option value="{{$month}}">{{date('F',  mktime(0, 0, 0, $month,  1))}}</option>
                                    @endforeach

                                </select>
                                <!-- Tombol Cari -->
                                <button class="btn btn-light d-inline w-15" wire:click="searchData">Cari</button>

                            </div>
                        </div>
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

                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                <!-- Tombol First  -->
                                @if ($getLaporan->currentPage() > 3)
                                <li class="page-item">
                                    <a class="page-link" wire:click="gotoPage(1)" style="cursor: pointer;">
                                        &laquo; First
                                    </a>
                                </li>
                                @endif

                                <!-- Tombol Previous  -->
                                <li class="page-item {{ $getLaporan->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                        &laquo; Previous
                                    </a>
                                </li>

                                <!-- Menampilkan maksimal 3 halaman sebelum dan sesudah halaman saat ini -->
                                @php
                                $start = max($getLaporan->currentPage() - 2, 1);
                                $end = min($getLaporan->currentPage() + 2, $getLaporan->lastPage());
                                @endphp

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $page == $getLaporan->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                    </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ !$getLaporan->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            Next &raquo;
                                        </a>
                                    </li>

                                    <!-- Tombol Last-->
                                    @if ($getLaporan->currentPage() < $getLaporan->lastPage() - 2)
                                        <li class="page-item">
                                            <a class="page-link" wire:click="gotoPage({{ $getLaporan->lastPage() }})" style="cursor: pointer;">
                                                Last &raquo;
                                            </a>
                                        </li>
                                        @endif
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>