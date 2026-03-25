<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Lazy;
use Livewire\Component;

class Ubicanos extends Component
{

    public function render()
    {
        $socialNetworks = \App\Models\PageDetalleContacto::with('catalagoTipo')
            ->where('status_id', 1)
            ->whereHas('catalagoTipo', function ($query) {
                $query->where('contacto_tipo_id', 1); // 1 is 'Redes Sociales' based on ContactSeeder
            })
            ->get();

        return view('livewire.dashboard.ubicanos', compact('socialNetworks'));
    }
}
