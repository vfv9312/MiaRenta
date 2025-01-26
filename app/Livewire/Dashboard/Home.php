<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Home extends Component
{
    public $selectedButton = '1';
    public $selectedLanguage = 'es';
    public $menu;
    public $visibleItems = 6;
    public $data;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
