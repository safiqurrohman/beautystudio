<div>
    <div class="container-fluid">
        <!-- <div class="container-fluid ms-5"> -->
        <div class="row">
            <h2 class="mt-2 mb-4 " style="font-weight: 700;">DASHBOARD</h2>
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow" style="border-radius: 10px;">
                        <div class="card-body text-center text-white" style="background-color:rgb(247, 37, 107); border-radius:10px">
                            <h5 class="card-title">Customer</h5>
                            <p class="card-text display-4" style="font-size: 40px; font-weight: 700">{{ $customerAV}}</p>
                            <!-- <a href="#" class="btn btn-primary">View Details</a> -->
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow" style="border-radius: 10px;">
                        <div class="card-body text-center bg-warning text-white" style="border-radius: 10px;">
                            <h5 class="card-title">Treatment</h5>
                            <p class="card-text display-4" style="font-size: 40px; font-weight: 700">{{$treatmentAV}}</p>
                            <!-- <a href="#" class="btn btn-primary">View Details</a> -->
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow" style="border-radius: 10px;">
                        <div class="card-body text-center  bg-primary text-white" style="border-radius: 10px;">
                            <h5 class="card-title">Income / {{$years}}</h5>
                            <p class="card-text display-4" style="font-size: 40px; font-weight: 700">Rp{{number_format($incomeAV, 0, ',', '.')}}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->role == 'admin')
            <!-- Card 4 -->
            <div class="row mt-5">
                <div class="col-md-5 mt-1">
                    <div class="card">
                        <div class="card-body text-center text-white">
                            <h5 class="card-title text-start text-dark" style="font-size: 25px;">Pendapatan Bulanan</h5>
                            <div class="row card-body col-md-12">
                                <button class="btn btn-dark col-md-12 my-2" wire:click="searchData">Cari</button>
                                <div class="d-flex gap-1">
                                    <div class="col-md-4">
                                        <select wire:model="viewType" id="viewType" class="form-select">
                                            <option value="monthly">Bulan</option>
                                            <option value="yearly">Tahun</option>
                                        </select>
                                    </div>
                                    @if ($viewType === 'monthly')
                                    <div class="col-md-4">
                                        <select wire:model="selectedMonth" id="selectedMonth" class="form-select">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
                                        <select wire:model="selectedYear" id="selectedYear" class="form-select">
                                            @for ($year = now()->year; $year >= now()->year - 10; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="col-md-7 mt-1">
                    <div class="card">
                        <div class="card-body text-center text-white">

                            <div class="row font-weight-bold pb-2 text-dark" style="border-bottom: 1px solid rgb(0, 0, 0)">
                                <div class="col" style="font-size: 20px; font-weight: 700">Tahun</div>
                                <div class="col" style="font-size: 20px; font-weight: 700">Customer</div>
                                <div class="col" style="font-size: 20px; font-weight: 700">Income</div>
                            </div>
                            @if ($searchTriggered)
                            <!-- Data -->
                            <div class="row pt-2 text-dark mt-4">
                                <div class=" col" style="font-size: 17px;">
                                    @if($viewType == 'monthly')
                                    {{ \Carbon\Carbon::create()->month($selectedMonth)->translatedFormat('F') }},
                                    @endif
                                    {{$selectedYear}}
                                </div>
                                <div class="col" style="font-size: 17px;">{{$customers}}</div>
                                <div class="col" style="font-size: 17px;">Rp{{ number_format($income, 0, ',', '.') }}</div>
                            </div>
                            @elseif(!$searchTriggered)
                            <div class="row pt-2 text-dark mt-4">
                                <div class="col" style="font-size: 17px;">Tahun</div>
                                <div class="col" style="font-size: 17px;">jumlah</div>
                                <div class="col" style="font-size: 17px;">Rp0</div>
                            </div>
                            @endif
                            <div class="row pt-2 text-dark" style="height: 63px;">

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            @endif

            <!-- Recent Activity Table -->
            <div class="row mt-4">
                <div class="col-md-5 mt-3">
                    <div class="col-lg-12 mx-auto">
                        <div class="card">
                            <h4 class="mx-4">Karyawan</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getKaryawan as $karyawan)
                                    <tr>
                                        @if($karyawan->role == 'karyawan')
                                        <td>{{($getKaryawan->currentPage() -1) * $getKaryawan->perPage() + $loop->iteration}}</td>
                                        <td>{{$karyawan->name}}</td>
                                        <td>{{$karyawan->created_at->format('d-F-Y')}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav class="mt-3">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item {{ $getKaryawan->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" wire:click="previousPage" wire:loading.attr="disabled" style="cursor: pointer;">&laquo; Previous</a>
                                    </li>
                                    @for ($page = 1; $page <= $getKaryawan->lastPage(); $page++)
                                        <li class="page-item {{ $page == $getKaryawan->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" wire:click="gotoPage({{ $page }})" style="cursor: pointer;">{{ $page }}</a>
                                        </li>
                                        @endfor
                                        <li class="page-item {{ !$getKaryawan->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link" wire:click="nextPage" wire:loading.attr="disabled" style="cursor: pointer;">Next &raquo;</a>
                                        </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <!-- Live Calendar -->
                    <div class="col-lg-12 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 text-center">Kalender</h4>
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
    });
</script>