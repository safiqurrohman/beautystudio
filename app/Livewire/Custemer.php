<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Custemer as ModelCustomer;
use App\Models\Transaksi;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Treatment;
use Carbon\Carbon;

class Custemer extends Component
{
    use WithPagination;

    public $pilihanMenu = 'lihat';
    public $nama, $phone, $address, $id_treatment, $id_karyawan, $bayar;
    public $id_custemer, $id_transaksi, $id_laporan;

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

        $customer = ModelCustomer::create([
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


        Transaksi::create([
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


    public function pilihedit($id)
    {
        $customer = ModelCustomer::findOrFail($id);
        $this->id_custemer = $customer->id;
        $this->nama = $customer->nama;
        $this->phone = $customer->phone;
        $this->address = $customer->address;

        $transaksi = Transaksi::where('id_custemer', $id)->first();
        if ($transaksi) {
            $this->id_transaksi = $transaksi->id;
            $this->id_treatment = $transaksi->id_treatment;
            $this->id_karyawan = $transaksi->id_karyawan; 
            $this->bayar = $transaksi->bayar;
        }

        $laporan = Laporan::where('nama', $customer->nama)->first();
        if ($laporan) {
            $this->id_laporan = $laporan->id;
        }

        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'id_treatment' => 'required|exists:treatment,id',
            'id_karyawan' => 'required|exists:users,id',
            'bayar' => 'required|numeric|min:0',
        ]);

        $customer = ModelCustomer::findOrFail($this->id_custemer);
        $customer->update([
            'nama' => $this->nama,
            'phone' => $this->phone,
            'address' => $this->address,
            'id_karyawan' => $this->id_karyawan,
            'id_treatment' => $this->id_treatment
        ]);

        $transaksi = Transaksi::find($this->id_transaksi);
        if ($transaksi) {
            $transaksi->update([
                'id_karyawan' => $this->id_karyawan,
                'id_treatment' => $this->id_treatment,
                'bayar' => $this->bayar,
                'tanggal_transaksi' => Carbon::now(),
            ]);
        }

        $laporan = Laporan::find($this->id_laporan);
        if ($laporan) {
            $treatment = Treatment::findOrFail($this->id_treatment);
            $harga = $treatment->harga;
            $komisi = $harga * 0.1;

            $laporan->update([
                'nama_karyawan' => User::findOrFail($this->id_karyawan)->name,
                'nama_customer' => $this->nama,
                'nama_treatment' => $treatment->nama, 
                'harga_treatment' => $harga,
                'komisi' => $komisi,
                'tanggal_transaksi' => Carbon::now(),
            ]);
        }

        $this->reset(['nama', 'phone', 'address', 'id_treatment', 'id_karyawan', 'bayar', 'id_custemer', 'id_transaksi', 'id_laporan']);
        $this->pilihanMenu = 'lihat';

        session()->flash('message', 'Data Customer, Transaksi, dan Laporan berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.custemer', [
            'getKaryawan' => User::all(),
            'getTreatment' => Treatment::all(),
            'getCustomer' => ModelCustomer::with(['karyawan', 'treatment'])->select('nama','phone', 'address','id_karyawan', 'id_treatment', 'created_at')->paginate(10),
        ]);
    }
}
