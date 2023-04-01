<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class HapusPinjaman extends Component
{
    public $redirect;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($redirect = null)
    {
        $this->redirect = $redirect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.hapus-pinjaman');
    }
}
