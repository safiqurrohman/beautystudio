<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Laporan as ModelLaporan;

class Laporan extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.laporan', [
            'getLaporan' => ModelLaporan::with(['karyawan', 'customer', 'treatment'])
            ->select('id', 'id_custemer', 'id_treatment', 'created_at', 'harga', 'komisi')
                ->paginate(10)
        ]);
    }
    
}
