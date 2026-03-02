<?php

namespace App\Livewire\Dashboard;

use App\Models\PageFactura;
use Livewire\Component;

class Factura extends Component
{
    public $instruccion_1;
    public $instruccion_2;
    public $instruccion_3;
    public $instruccion_4;
    public $faq_title;
    public $faq_body;

    public function mount()
    {
        $page = PageFactura::first();

        $this->instruccion_1 = $page->instruccion_1 ?? 'Solo dentro del mes fiscal de la compra.';
        $this->instruccion_2 = $page->instruccion_2 ?? 'Adjuntar Constancia Fiscal y Nota de Renta.';
        $this->instruccion_3 = $page->instruccion_3 ?? 'Tiempo de entrega: 2 días hábiles.';
        $this->instruccion_4 = $page->instruccion_4 ?? 'Lunes a Viernes de 9:00 AM a 9:00 PM.';
        $this->faq_title     = $page->faq_title ?? '¿Dónde recibo mi factura?';
        $this->faq_body      = $page->faq_body  ?? 'Se enviará automáticamente a tu email una vez procesada por nuestro equipo contable.';
    }

    public function render()
    {
        return view('livewire.dashboard.factura');
    }
}
