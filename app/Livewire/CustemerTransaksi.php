<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Custemer as ModelCustemer;
use App\Models\Transaksi;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Treatment;
use Carbon\Carbon;

class Custemer extends Component
{
    use WithPagination;

    public $pilihanMenu = 'lihat';
    public $nama, $phone, $id, $id_treatment;
    public $karyawanList, $treatmentList;


    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function mount()
    {
        $this->karyawanList = User::where('role', 'karyawan')->get();
        $this->treatmentList = Treatment::all();
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'phone' => 'required',
            'id' => 'required|exists:users,id',
            'id_treatment' => 'required|exists:treatment,id',
        ]);

        $customer = Custemer::create([
            'nama' => $this->nama,
            'phone' => $this->phone,
            'id_treatment' => $this->id_treatment,
            'id' => $this->id
        ]);

        Transaksi::create([
            'id_custemer' => $customer->id_custemer,
            'id' => $this->id,
            'id_treatment' => $this->id_treatment,
        ]);

        $treatment = Treatment::find($this->id_treatment);
        $harga = $treatment->harga;

        // **Perhitungan Komisi**
        if ($harga < 100000) {
            $komisi = 2000;
        } elseif ($harga >= 100000 && $harga <= 200000) {
            $komisi = 4000;
        } else {
            $komisi = 6000;
        }

        Laporan::create([
            'id' => $this->id,
            'id_custemer' => $customer->id_custemer,
            'id_treatment' => $this->id_treatment,
            'harga' => $treatment->harga,
            'komisi' => $komisi,
            'tanggal' => Carbon::now(),
        ]);

        session()->flash('message', 'Data berhasil disimpan');

        $this->reset(['nama', 'phone', 'id', 'id_treatment']);
    }

    public function render()
    {
        $getCustemer = ModelCustemer::with(['treatment', 'user'])->paginate(10);

        return view('livewire.custemer', compact('getCustemer'));
    }
}
