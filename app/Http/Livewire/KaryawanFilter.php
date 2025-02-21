<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Karyawan;
use App\Models\Divisi;

class KaryawanFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $divisi_id = '';

    protected $queryString = ['search', 'divisi_id']; // Simpan filter dalam URL

    public function resetFilters()
    {
        $this->search = '';
        $this->divisi_id = '';
    }

    public function render()
    {
        $karyawan = Karyawan::query()
            ->when($this->search, function ($query) {
                return $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->when($this->divisi_id, function ($query) {
                return $query->where('divisi_id', $this->divisi_id);
            })
            ->orderBy('nama', 'asc')
            ->paginate(10)
            ->withQueryString();

        $divisi = Divisi::all();

        return view('livewire.karyawan-filter', compact('karyawan', 'divisi'));
    }
}
