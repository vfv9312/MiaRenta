<?php

namespace App\Livewire\Dashboard;

use App\Models\PageNosotros;
use Livewire\Attributes\Lazy;
use Livewire\Component;

class Nosotros extends Component
{
    public $page_nosotros;

    public function mount()
    {
        $this->page_nosotros = PageNosotros::first();
    }

    public function render()
    {
        return view('livewire.dashboard.nosotros');
    }
}
