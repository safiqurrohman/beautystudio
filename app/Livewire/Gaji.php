<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Laporan;
use Carbon\Carbon;

class Gaji extends Component
{
    use WithPagination;

    public $selectedMonth;
    public $selectedYear;
    public $selectedKaryawan;
    public $searchTriggered = false;
    public $totalGaji = 0;
    public $pilihanMenu = 'gaji';
    public $years = [];

    public function mount()
    {
        if (auth()->User()->role == 'karyawan') {
            $this->pilihanMenu = 'karyawan';
        }
        $this->selectedMonth = Carbon::now()->month; // Default ke bulan ini
        $this->selectedYear = Carbon::now()->year; // Default ke tahun ini
        $this->selectedKaryawan = ''; // Default tidak memilih karyawan

        // Mengambil daftar tahun unik dari database
        $this->years = Laporan::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        $this->hitungTotalGaji();
    }

    public function pilihMenu($menu)
    {
        if(auth()->User()->role == 'karyawan'){
            $this->pilihanMenu == 'karyawan';
        }else{
            $this->pilihanMenu = $menu;
        }
    }

    public function hitungTotalGaji()
    {
        $query = Laporan::query()
            ->whereMonth('created_at', $this->selectedMonth)
            ->whereYear('created_at', $this->selectedYear);

        if ($this->selectedKaryawan) {
            $query->where('id', $this->selectedKaryawan);
        }

        $this->totalGaji = $query->sum('komisi');
    }

    public function searchData()
    {
        $this->searchTriggered = true;
        $this->hitungTotalGaji();
    }

    public function render()
    {
        return view('livewire.gaji', [
            'months' => range(1, 12),
            'years' => $this->years,
            'totalGaji' => $this->totalGaji,
            'karyawanList' => User::where('role', 'karyawan')->get(),
            'laporan' => Laporan::whereMonth('created_at', $this->selectedMonth)
                ->whereYear('created_at', $this->selectedYear)
                ->when($this->selectedKaryawan, function ($query) {
                    $query->where('id', $this->selectedKaryawan);
                })
                ->paginate(10),
        ]);
    }
}
