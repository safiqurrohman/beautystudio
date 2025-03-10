<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Treatment as ModelTreatment;

class Treatment extends Component
{

    use WithPagination;
    public  $pilihanMenu = 'lihat';
    public $nama;
    public $kategori;
    public $harga;
    public $piltretament;

    public function mount()
    {
        if (auth()->User()->role != 'admin') {
            abort(403);
        }
    }

    public function pilihMenu($menu)
    {

        $this->pilihanMenu = $menu;
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'kategori.required' => 'Kategori Harus Diisi',
            'harga.required' => 'Harga Harus Diisi'
        ]);
        $simpan = new ModelTreatment();
        $simpan->nama = $this->nama;
        $simpan->kategori = $this->kategori;
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kategori', 'harga']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihedit($id)
    {
        $this->piltretament= ModelTreatment::findOrFail($id);

        $this->nama = $this->piltretament->nama;
        $this->kategori = $this->piltretament->kategori;
        $this->harga = $this->piltretament->harga;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required'
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'kategori.required' => 'Kategori Harus Diisi',
            'harga.required' => 'Harga Harus Diisi'
        ]);
        $simpan = $this->piltretament;
        $simpan->nama = $this->nama;
        $simpan->kategori = $this->kategori;
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kategori', 'harga', 'piltretament']);
        $this->pilihanMenu = 'lihat';
    }


    public function pilihhapus($id)
    {
        $this->piltretament = ModelTreatment::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        if ($this->piltretament) {
            $this->piltretament->delete();
        }

        $this->reset(['piltretament']);
        $this->pilihanMenu = 'lihat';


        $this->dispatch('tutupModal');
    }

    public function batal()
    {
        $this->reset(['nama', 'kategori', 'harga', 'piltretament']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->pilihanMenu = 'lihat';

        $this->dispatch('tutupModal');
    }

    public function render()
    {
        return view('livewire.treatment', [
            'getTreatment' => ModelTreatment::select('id', 'nama', 'kategori', 'harga')->paginate(10)
        ]);
        // return view('livewire.treatment')->with(
        //     ['getTreatment' => ModelTreatment::all()
        //     ]
        // );
    }
}
