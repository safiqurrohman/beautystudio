<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaksi as ModelTransaksi;

class Transaksi extends Component
{
    use WithPagination;
    public $pilihanMenu = 'lihat';
    
    public function pilihMenu($menu)
    {

        $this->pilihanMenu = $menu;
    }


    public function render()
    {
        return view('livewire.transaksi', [
            'getTransaksi' => ModelTransaksi::with(['karyawan', 'customer', 'treatment'])
            ->select('id', 'id_custemer', 'id_treatment', 'created_at', 'updated_at')
            ->paginate(10)
        ]);
    }
}
