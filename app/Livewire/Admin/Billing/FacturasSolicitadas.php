<?php

namespace App\Livewire\Admin\Billing;

use App\Helpers\Utility;
use App\Models\FacturaSolicitada;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class FacturasSolicitadas extends Component
{
    use WithFileUploads, WithPagination;

    public $search = '';
    public $filtroEstatus = '';

    // Modal de detalle / subir factura
    public $modalAbierto = false;
    public $facturaId;
    public $facturaItem;
    public $nuevaFactura;

    protected $queryString = ['search', 'filtroEstatus'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function abrirModal($id)
    {
        $this->facturaId   = $id;
        $this->facturaItem = FacturaSolicitada::findOrFail($id);
        $this->nuevaFactura = null;
        $this->modalAbierto = true;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
        $this->facturaId    = null;
        $this->facturaItem  = null;
        $this->nuevaFactura = null;
    }

    public function subirFactura()
    {
        $this->validate([
            'nuevaFactura' => 'required|file|mimes:pdf,xml,zip|max:10240',
        ], [
            'nuevaFactura.required' => 'Debes seleccionar un archivo.',
            'nuevaFactura.mimes'    => 'Solo se permiten archivos PDF, XML o ZIP.',
            'nuevaFactura.max'      => 'El archivo no debe pesar más de 10 MB.',
        ]);

        $record = FacturaSolicitada::findOrFail($this->facturaId);

        // Eliminar archivo anterior si existe
        if ($record->factura_path && File::exists(public_path($record->factura_path))) {
            File::delete(public_path($record->factura_path));
        }

        $path = Utility::saveFile($this->nuevaFactura, 'facturas');

        $record->update([
            'factura_path' => $path,
        ]);

        $this->facturaItem  = $record->fresh();
        $this->nuevaFactura = null;
        session()->flash('message', 'Factura subida correctamente.');
    }

    public function marcarComoEnviada($id)
    {
        $record = FacturaSolicitada::findOrFail($id);
        $record->update(['estatus' => 'enviada']);

        if ($this->facturaItem && $this->facturaItem->id === $id) {
            $this->facturaItem = $record->fresh();
        }

        session()->flash('message', 'Factura marcada como enviada.');
    }

    public function render()
    {
        $facturas = FacturaSolicitada::query()
            ->when($this->search, function ($q) {
                $q->where('numero_ticket', 'like', '%' . $this->search . '%')
                    ->orWhere('rfc', 'like', '%' . $this->search . '%')
                    ->orWhere('razon_social', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->filtroEstatus, fn($q) => $q->where('estatus', $this->filtroEstatus))
            ->latest()
            ->paginate(15);

        return view('livewire.admin.billing.facturas-solicitadas', compact('facturas'));
    }
}
