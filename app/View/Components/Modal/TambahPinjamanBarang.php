<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;
use App\Models\Pinjaman;

class TambahPinjamanBarang extends Component
{
    public $barangs;
    public $pinjaman;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($barangs, Pinjaman $pinjaman)
    {
        $this->barangs = $barangs;
        $this->pinjaman = $pinjaman;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.tambah-pinjaman-barang');
    }
}
