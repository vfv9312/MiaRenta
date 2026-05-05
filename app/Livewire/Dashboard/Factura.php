<?php

namespace App\Livewire\Dashboard;

use App\Models\PageFactura;
use App\Models\FacturaSolicitada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacturaSolicitadaMail;
use Livewire\Component;
use Livewire\WithFileUploads;

class Factura extends Component
{
    use WithFileUploads;

    public $instruccion_1;
    public $instruccion_2;
    public $instruccion_3;
    public $instruccion_4;
    public $faq_title;
    public $faq_body;

    public $numero_ticket;
    public $rfc;
    public $razon_social;
    public $regimen;
    public $uso_cfdi;
    public $cp;
    public $email;
    public $constancia;
    public $nota;

    protected $rules = [
        'numero_ticket' => 'required|string|max:255',
        'rfc'           => 'required|string|max:13',
        'razon_social'  => 'required|string|max:255',
        'regimen'       => 'required|string',
        'uso_cfdi'      => 'required|string',
        'cp'            => 'required|digits:5',
        'email'         => 'required|email|max:255',
        'constancia'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'nota'          => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ];

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

    public function save()
    {
        $this->validate();

        $constanciaPath = $this->constancia->store('facturas', 'public');
        $notaPath = $this->nota->store('facturas', 'public');

        $facturaSolicitada = FacturaSolicitada::create([
            'numero_ticket' => $this->numero_ticket,
            'rfc'           => strtoupper($this->rfc),
            'razon_social'  => strtoupper($this->razon_social),
            'regimen'       => $this->regimen,
            'uso_cfdi'      => $this->uso_cfdi,
            'cp'            => $this->cp,
            'email'         => $this->email,
            'constancia_path' => $constanciaPath,
            'nota_path'     => $notaPath,
        ]);

        $adminEmail = DB::table('_detalles_contacto')
            ->where('contacto_data_tipo_id', 8)
            ->value('recurso');

        if ($adminEmail) {
            Mail::to($adminEmail)->send(new FacturaSolicitadaMail($facturaSolicitada));
        }

        $this->reset(['numero_ticket', 'rfc', 'razon_social', 'regimen', 'uso_cfdi', 'cp', 'email', 'constancia', 'nota']);
        
        session()->flash('success', '¡Su solicitud de factura ha sido enviada con éxito!');
    }

    public function render()
    {
        return view('livewire.dashboard.factura');
    }
}
