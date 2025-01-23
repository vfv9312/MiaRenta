<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;

    public function render()
    {
        return view('livewire.user.index');
    }

    public function mount(){
        $this->users = User::all();
    }
}
