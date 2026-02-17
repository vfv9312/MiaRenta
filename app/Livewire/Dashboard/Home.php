<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Lazy;
use Livewire\Component;

class Home extends Component
{
    public $images = [];

    public function mount()
    {
        $this->images = [
            ['src' => '0.jpeg', 'alt' => 'Evento 1'],
            ['src' => '2.jpg', 'alt' => 'Evento 2'],
            ['src' => '3.jpg', 'alt' => 'Evento 3'],
            ['src' => '4.jpg', 'alt' => 'Evento 4'],
            ['src' => '5.jpg', 'alt' => 'Evento 5'],
            ['src' => '6.jpg', 'alt' => 'Evento 6'],
            ['src' => '7.jpeg', 'alt' => 'Evento 7'],
            ['src' => '8.jpg', 'alt' => 'Evento 8'],
            ['src' => '9.jpg', 'alt' => 'Evento 9'],
            ['src' => '10.jpeg', 'alt' => 'Evento 10'],
            ['src' => '11.jpeg', 'alt' => 'Evento 11'],
            ['src' => '12.jpg', 'alt' => 'Evento 12'],
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
