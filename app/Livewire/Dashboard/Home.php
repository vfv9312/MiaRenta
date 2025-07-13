<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Lazy;
use Livewire\Component;

class Home extends Component
{
    public $items = [];


    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
