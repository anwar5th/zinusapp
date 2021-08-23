<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Asset;

class Assets extends Component
{
    public $assets, $asset_id, $type, $location, $department, $name, $manufacture, $atribut;
    public $isModal = 0;

    //fungsi load ke halaman asset
    public function render()
    {
        $this->assets = Asset::orderBy('created_at', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.assets'); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
    }

    //fungsi untuk memanggil tampilan creat saat mengklik tombol tambah
    public function create()
    {
        //fungsi untuk mengkosongkan field
        $this->resetFields();
        //fungsi untuk membuka modal tampilan
        $this->openModal();
    }

    //fungsi untuk menutup modal
    public function closeModal()
    {
        $this->isModal = false;
    }

    //fungsi untuk membuka modal
    public function openModal()
    {
        $this->isModal = true;
    }

    //fungsi untuk mereset filed agar menjadi kosong
    public function resetFields()
    {
        $this->asset_id = '';
        $this->type = '';
        $this->location = '';
        $this->department = '';
        $this->name = '';
        $this->manufacture = '';
        $this->atribut = '';
    }

    //method untuk menyimpan dan update data
    public function store()
    {
        //falidasi
        $this->validate([
            'asset_id' => 'required|string',
            'type' => 'required|string',
            'location' => 'required|string',
            'department' => 'required|string',
            'name' => 'required|string',
            'manufacture' => 'required|string',
            'atribut' => 'required|string'
        ]);

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        Asset::updateOrCreate(['id' => $this->id], [
            'asset_id' => $this->asset_id,
            'type' => $this->type,
            'location' => $this->location,
            'department' => $this->department,
            'name' => $this->name,
            'manufacture' => $this->manufacture,
            'atribut' => $this->atribut,
        ]);

        //untuk menampilkan alert notifikasi
        session()->flash('message', $this->id ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //fungsi untuk memanggil data dari database berdasarkan id table
    public function edit($id)
    {
        $assets = Asset::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id = $id;
        $this->asset_id = $assets->asset_id;
        $this->type = $assets->type;
        $this->location = $assets->location;
        $this->department = $assets->department;
        $this->name = $assets->name;
        $this->manufacture = $assets->manufacture;
        $this->atribut = $assets->atribut;

        $this->openModal(); //LALU BUKA MODAL
    }

    //fungsi menghapus data
    public function delete($id)
    {
        $assets = Asset::find($id); //query untuk mengambil data berdasarkan id
        $assets->delete(); //hapus data
        session()->flash('message', $assets->name . ' Dihapus'); //notifikasi message
    }
}
