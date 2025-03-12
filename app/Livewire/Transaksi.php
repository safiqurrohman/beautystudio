<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Custemer;
use App\Models\Transaksi as ModelTransaksi;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Treatment;
use Carbon\Carbon;

class Transaksi extends Component
{
    use WithPagination;

    public $pilihanMenu = 'tambah';
    public $nama, $phone, $address, $id_treatment, $id_karyawan, $bayar;
    public $id_custemer, $id_transaksi, $id_laporan;

    public function mount()
    {
        if(auth()->User()->role != 'karyawan'){
            abort(403);
        }
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_karyawan', 'id');
    }


    public function simpan()
    {
        // Validasi input 
        $this->validate([
            'nama' => 'required',
            'phone' => ['required', 'string', 'max:15'],
            'address' => 'required|string|max:255',
            'id_treatment' => ['required', 'exists:treatment,id'],
            'id_karyawan' => ['required', 'exists:users,id'],
            'bayar' => ['required', 'numeric', 'min:0'],
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'phone.required' => 'Nomor Telepon Harus Diisi',
            'phone.string' => 'Nomor Telepon Harus Berupa Teks',
            'phone.max' => 'Nomor Telepon Maksimal 15 Karakter',
            'address.required' => 'Alamat Harus Diisi',
            'id_treatment.required' => 'Silakan Pilih Treatment',
            'id_treatment.exists' => 'Treatment yang Dipilih Tidak Valid',
            'id_karyawan.required' => 'Silakan Pilih Karyawan',
            'id_karyawan.exists' => 'Karyawan yang Dipilih Tidak Valid',
            'bayar.required' => 'Jumlah Pembayaran Harus Diisi',
            'bayar.numeric' => 'Pembayaran Harus Berupa Angka',
            'bayar.min' => 'Pembayaran Tidak Bisa Kurang dari 0',
        ]);

        $customer = Custemer::create([
            'nama' => $this->nama,
            'phone' => $this->phone,
            'address' => $this->address,
            'id_karyawan' => $this->id_karyawan,
            'id_treatment'  => $this->id_treatment
        ]);

        $id_customer = $customer->id;

        $treatment = Treatment::findOrFail($this->id_treatment);
        $harga = $treatment->harga;

        // **Perhitungan Komisi**
        if ($harga < 100000) {
            $komisi = 2000;
        } elseif ($harga >= 100000 && $harga <= 200000) {
            $komisi = 4000;
        } else {
            $komisi = 6000;
        }


        ModelTransaksi::create([
            'id_custemer' => $id_customer,
            'id' => $this->id_karyawan,
            'id_treatment' => $this->id_treatment,
            // 'tanggal_transaksi' => Carbon::now(),
        ]);

        Laporan::create([
            'id' => $this->id_karyawan,
            'id_custemer' => $id_customer,
            'id_treatment' => $this->id_treatment,
            'harga' => $harga,
            'komisi' => $komisi
        ]);

        $this->reset(['nama', 'phone', 'address', 'id_treatment', 'id_karyawan', 'bayar']);
        $this->pilihanMenu = 'lihat';

        session()->flash('message', 'Customer & Transaksi berhasil disimpan!');
    }

    public function render()
    {
        // return view('livewire.transaksi', [

        //     'getTransaksi' => ModelTransaksi::with(['karyawan', 'customer', 'treatment'])
        //         ->select('id', 'id_custemer', 'id_treatment', 'created_at', 'updated_at')
        //         ->paginate(10)
        // ]);
        return view('livewire.transaksi', [
            'getKaryawan' => User::all(),
            'getTreatment' => Treatment::all(),
            'getTransaksi' => ModelTransaksi::with(['karyawan', 'customer', 'treatment'])->select('id_custemer', 'id', 'id_treatment', 'created_at', 'updated_at')->paginate(10),
        ]);
    }
}
