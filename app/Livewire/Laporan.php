<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Laporan as ModelLaporan;
use Carbon\Carbon;

class Laporan extends Component
{
    use WithPagination;

    public $selectedMonth;
    public $selectedYear;
    public $searchTriggered = false;
    public $years = [];


    public function mount()
    {
        $this->selectedMonth = Carbon::now()->month;
        $this->selectedYear = Carbon::now()->year;
        

        $this->years = ModelLaporan::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    public function lihatLaporan()
    {
        $query = ModelLaporan::query()
            ->whereMonth('created_at', $this->selectedMonth)
            ->whereYear('created_at', $this->selectedYear);

    }

    public function searchData()
    {
        $this->searchTriggered = true;
        $this->lihatLaporan();
    }

    public function render()
    {
        return view('livewire.laporan', [
            'months' => range(1, 12),
            'years' => $this->years,
            'getLaporan' => ModelLaporan::whereMonth('created_at', $this->selectedMonth)
                ->whereYear('created_at', $this->selectedYear)
                ->paginate(10),
            // 'getLaporan' => ModelLaporan::with(['karyawan', 'customer', 'treatment'])
            // ->select('id', 'id_custemer', 'id_treatment', 'created_at', 'harga', 'komisi')
            //     ->paginate(10)
        ]);
    }
    
}
