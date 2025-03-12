<div>
    <div class="container-fluid">
        <div class="row">
            <h4 class="mt-2">DATA GAJI KARYAWAN</h4>
            <div class="col-md-12 my-2">
                @if(auth()->user()->role == 'admin')
                <button wire:click="pilihMenu('gaji')" class="btn btn-primary">Data Gaji</button>
                @endif
                <button wire:click="pilihMenu('karyawan')" class="btn btn-primary">Karyawan</button>
                <button class="btn btn-warning">Download</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 card border-secondary">
                @if($pilihanMenu == 'gaji' && auth()->check() && auth()->user()->role == 'admin')
                <div class="col-md-12 row">
                    <div class="col-md-6 my-2 px-2">
                        <h5 class="mb-0 btn bg-warning">Pengeluaran Gaji Bulanan</h5>
                    </div>
                    <div class="col-md-6 text-end my-2 px-2">
                        <!-- Pilihan Tahun -->
                        <select class="form-control d-inline w-25" wire:model="selectedYear">
                            <option value="">Pilih Tahun</option>
                            @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <!-- Pilihan Bulan -->
                        <select class="form-control d-inline w-25" wire:model="selectedMonth">
                            <option value="">Pilih Bulan</option>
                            @foreach ($months as $month)
                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endforeach
                        </select>
                        <!-- Tombol Cari -->
                        <button class="btn btn-primary" wire:click="searchData">Cari</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Karyawan</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Treatment</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Komisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y')}}</td>
                                    <td>{{ $item->karyawan->name}}</td>
                                    <td>{{ $item->customer->nama}}</td>
                                    <td>{{ $item->treatment->nama}}</td>
                                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($item->komisi, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr class="col-span-6">
                                    <td colspan="6"><strong>Total :</strong></td>
                                    <td><strong>Rp{{ number_format($totalGaji, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                <!-- Tombol First  -->
                                @if ($laporan->currentPage() > 3)
                                <li class="page-item">
                                    <a class="page-link" wire:click="gotoPage(1)" style="cursor: pointer;">
                                        &laquo; First
                                    </a>
                                </li>
                                @endif

                                <!-- Tombol Previous  -->
                                <li class="page-item {{ $laporan->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                        &laquo; Previous
                                    </a>
                                </li>

                                <!-- Menampilkan maksimal 3 halaman sebelum dan sesudah halaman saat ini -->
                                @php
                                $start = max($laporan->currentPage() - 2, 1);
                                $end = min($laporan->currentPage() + 2, $laporan->lastPage());
                                @endphp

                                @for ($page = $start; $page <= $end; $page++)
                                    <li class="page-item {{ $page == $laporan->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                    </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ !$laporan->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            Next &raquo;
                                        </a>
                                    </li>

                                    <!-- Tombol Last-->
                                    @if ($laporan->currentPage() < $laporan->lastPage() - 2)
                                        <li class="page-item">
                                            <a class="page-link" wire:click="gotoPage({{ $laporan->lastPage() }})" style="cursor: pointer;">
                                                Last &raquo;
                                            </a>
                                        </li>
                                        @endif
                            </ul>
                        </nav>


                    </div>
                </div>
                @elseif($pilihanMenu == 'karyawan')
                <div class="col-md-12 row">
                    <div class="col-md-6 my-2 px-2">
                        <h5 class="mb-0 btn bg-warning">Laporan Gaji</h5>
                    </div>
                    <div class="col-md-6 text-end my-2 px-2">
                        <!-- Pilihan Tahun -->
                        <select class="form-control d-inline w-25" wire:model="selectedYear">
                            <option value="">Pilih Tahun</option>
                            @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <!-- Pilihan Bulan -->
                        <select class="form-control d-inline w-25" wire:model="selectedMonth">
                            <option value="">Pilih Bulan</option>
                            @foreach ($months as $month)
                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                            @endforeach
                        </select>
                        <!-- Pilihan Karyawan -->
                        <select class="form-control d-inline w-25" wire:model="selectedKaryawan">
                            <option value="">Pilih</option>
                            @foreach ($karyawanList as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                            @endforeach
                        </select>
                        <!-- Tombol Cari -->
                        <button class="btn btn-primary" wire:click="searchData">Cari</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Karyawan</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Treatment</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Komisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                                    <td>{{ $item->karyawan->name ?? '-' }}</td>
                                    <td>{{ $item->customer->nama ?? '-' }}</td>
                                    <td>{{ $item->treatment->nama?? '-' }}</td>
                                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($item->komisi, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr class="col-span-6">
                                    <td colspan="6"><strong>Total Komisi :</strong></td>
                                    <td><strong>Rp{{ number_format($totalGaji, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                <li class="page-item {{ $laporan->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                        &laquo; Previous
                                    </a>
                                </li>
                                @for ($page = 1; $page <= $laporan->lastPage(); $page++)
                                    <li class="page-item {{ $page == $laporan->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                    </li>
                                    @endfor
                                    <li class="page-item {{ !$laporan->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            Next &raquo;
                                        </a>
                                    </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>