<?php

namespace App\Livewire\Dashboard;

use App\Models\carousel;
use App\Models\PageCatalag;
use App\Models\PageFooter;
use App\Models\PageNosotros;
use App\Models\PublicGallery;
use Livewire\Attributes\Lazy;
use Livewire\Component;

class Home extends Component
{
    public $images = [];
    public $slides = [];
    public $us = null;
    public $cta = null;

    public function mount()
    {
        $this->slides = carousel::latest()->where('activo', 1)->get();
        /* $this->slides = [
            [
                'image' => 'imagenes/carrusel/FONDO1.webp',
                'title' => 'Mía <span class="text-blue-500">Renta</span>',
                'subtitle' => 'Mobiliario elegante y de calidad para que tus festejos sean inolvidables.',
                'button_text' => 'Ver Mobiliario',
                'button_link' => '#servicios'
            ],
            [
                'image' => 'imagenes/imagenes/0.jpeg',
                'title' => 'Eventos <span class="text-blue-500">Elegantes</span>',
                'subtitle' => 'Contamos con la mejor mantelería y cristalería de Tuxtla Gutiérrez.',
                'button_text' => 'WhatsApp',
                'button_link' => 'https://wa.me/message/2FM4OVMRRIMIB1'
            ],
            [
                'image' => 'imagenes/imagenes/7.jpeg',
                'title' => 'Servicio <span class="text-blue-500">Premium</span>',
                'subtitle' => 'Puntualidad y limpieza en cada entrega para tu tranquilidad.',
                'button_text' => 'Sobre Nosotros',
                'button_link' => '#info'
            ],
        ];*/

        $this->images = PublicGallery::latest()->get();
        /* $this->images = [
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
        ];*/

        $this->us = PageCatalag::first();
        $this->cta = PageFooter::first();
    }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
