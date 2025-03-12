<div>
    <div class="container">
        <div class="row">
            <h4 style="margin-top: -10px;">DATA CUSTOMER</h4>
            <div class="col-12 my-2">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary'}}">
                    Data Customer
                </button>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Pagination">
                                <ul class="pagination">
                                    <!-- {{-- Tombol First --}} -->
                                    @if ($getCustomer->currentPage() > 3)
                                    <li class="page-item">
                                        <a class="page-link" wire:click="gotoPage(1)" style="cursor: pointer;">
                                            &laquo; First
                                        </a>
                                    </li>
                                    @endif

                                    <!-- {{-- Tombol Previous --}} -->
                                    <li class="page-item {{ $getCustomer->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                            &laquo; Previous
                                        </a>
                                    </li>

                                    <!-- {{-- Menampilkan maksimal 3 halaman sebelum dan sesudah halaman saat ini --}} -->
                                    @php
                                    $start = max($getCustomer->currentPage() - 2, 1);
                                    $end = min($getCustomer->currentPage() + 2, $getCustomer->lastPage());
                                    @endphp

                                    @for ($page = $start; $page <= $end; $page++)
                                        <li class="page-item {{ $page == $getCustomer->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                        </li>
                                        @endfor

                                        <!-- {{-- Tombol Next --}} -->
                                        <li class="page-item {{ !$getCustomer->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">
                                                Next &raquo;
                                            </a>
                                        </li>

                                        {{-- Tombol Last --}}
                                        @if ($getCustomer->currentPage() < $getCustomer->lastPage() - 2)
                                            <li class="page-item">
                                                <a class="page-link" wire:click="gotoPage({{ $getCustomer->lastPage() }})" style="cursor: pointer;">
                                                    Last &raquo;
                                                </a>
                                            </li>
                                            @endif
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>