<?php

namespace App\Livewire\Admin\Pages\Factura;

use App\Models\PageFactura;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $item_id;

    public $instruccion_1;
    public $instruccion_2;
    public $instruccion_3;
    public $instruccion_4;

    public $faq_title;
    public $faq_body;

    protected $rules = [
        'instruccion_1' => 'required|string|max:255',
        'instruccion_2' => 'required|string|max:255',
        'instruccion_3' => 'required|string|max:255',
        'instruccion_4' => 'required|string|max:255',
        'faq_title'     => 'required|string|max:255',
        'faq_body'      => 'required|string',
    ];

    public function mount()
    {
        $page = PageFactura::first();

        if ($page) {
            $this->item_id     = $page->id;
            $this->instruccion_1 = $page->instruccion_1;
            $this->instruccion_2 = $page->instruccion_2;
            $this->instruccion_3 = $page->instruccion_3;
            $this->instruccion_4 = $page->instruccion_4;
            $this->faq_title   = $page->faq_title;
            $this->faq_body    = $page->faq_body;
        } else {
            // Default values matching the current hardcoded content
            $this->instruccion_1 = 'Solo dentro del mes fiscal de la compra.';
            $this->instruccion_2 = 'Adjuntar Constancia Fiscal y Nota de Renta.';
            $this->instruccion_3 = 'Tiempo de entrega: 2 días hábiles.';
            $this->instruccion_4 = 'Lunes a Viernes de 9:00 AM a 9:00 PM.';
            $this->faq_title     = '¿Dónde recibo mi factura?';
            $this->faq_body      = 'Se enviará automáticamente a tu email una vez procesada por nuestro equipo contable.';
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'instruccion_1' => $this->instruccion_1,
            'instruccion_2' => $this->instruccion_2,
            'instruccion_3' => $this->instruccion_3,
            'instruccion_4' => $this->instruccion_4,
            'faq_title'     => $this->faq_title,
            'faq_body'      => $this->faq_body,
        ];

        DB::beginTransaction();
        try {
            $page = PageFactura::updateOrCreate(
                ['id' => $this->item_id],
                $data
            );

            $this->item_id = $page->id;

            DB::commit();
            session()->flash('message', 'Contenido de facturación actualizado correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('error', 'Ocurrió un error al actualizar el contenido.');
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.factura.index');
    }
}
