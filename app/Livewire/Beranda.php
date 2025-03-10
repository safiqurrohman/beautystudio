<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User as ModelUser;
use App\Models\Custemer;
use App\Models\Laporan;
use App\Models\Treatment;
use Carbon\Carbon;

class Beranda extends Component
{
    use WithPagination;

    public $customers = 0;
    public $treatments = 0;
    public $income = 0;

    public $customerAV;
    public $treatmentAV;
    public $incomeAV;

    public $selectedMonth;
    public $selectedYear;
    public $viewType;
    public $searchTriggered = false;

    public function mount()
    {
        if (auth()->user()->role == 'custemer') {
            return redirect('/welcom')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $this->selectedMonth = Carbon::now()->month; 
        $this->selectedYear = Carbon::now()->year;  
        $this->viewType = 'monthly'; 

        $this->customerAV = Custemer::count();
        $this->treatmentAV = Treatment::count();
        $this->incomeAV = Laporan::whereYear('created_at', $this->selectedYear)->sum('harga');
    }

    public function searchData()
    {
        $this->searchTriggered = true;
        $this->updateIncome();
    }

    private function updateIncome()
    {
        if (!$this->searchTriggered) {
            return;
        }

        if ($this->viewType === 'monthly') {
            $this->customers = Custemer::whereYear('created_at', $this->selectedYear)
                ->whereMonth('created_at', $this->selectedMonth)
                ->count();

            $this->income = Laporan::whereYear('created_at', $this->selectedYear)
                ->whereMonth('created_at', $this->selectedMonth)
                ->sum('harga');
        } else {
            $this->customers = Custemer::whereYear('created_at', $this->selectedYear)->count();
            $this->income = Laporan::whereYear('created_at', $this->selectedYear)->sum('harga');
        }
    }

    public function render()
    {
        return view('livewire.beranda', [ 
            'years' => now()->year,
            'getKaryawan' => ModelUser::where('role', 'karyawan')->paginate(5),
        ]);
    }
}
