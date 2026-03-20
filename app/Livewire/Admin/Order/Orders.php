<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Alquiler;
use App\Models\AlquileresProducto;
use App\Models\Status;
use App\Models\CatalagoPrecio;
use App\Models\Producto;
use App\Helpers\Utility;
use Illuminate\Support\Facades\DB;

class Orders extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $filter_status_id = '';

    // Modals visibility
    public $showCancelModal = false;
    public $showPaymentModal = false;
    public $showProductsModal = false;

    // Selected order
    public $selected_order_id = null;
    
    // Cancel Form
    public $motivo_cancelacion = '';

    // Payment Form
    public $monto_a_pagar = '';
    public $evidencia_pago; // file upload

    // Products Form
    public $search_product = '';
    public $selected_catalogo_precio_id = '';
    public $cantidad_producto = 1;

    protected $rules = [
        'motivo_cancelacion' => 'required_if:showCancelModal,true|string',
        'monto_a_pagar' => 'required_if:showPaymentModal,true|numeric|min:1',
        'evidencia_pago' => 'nullable|image|max:5120', // max 5mb
        'cantidad_producto' => 'required_if:showProductsModal,true|integer|min:1',
        'selected_catalogo_precio_id' => 'required_if:showProductsModal,true|exists:catalago_precios,id',
    ];

    public function updatingFilterStatusId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $alquileres_query = Alquiler::with(['cliente.persona', 'status', 'productos', 'metodoPago'])
            ->whereBetween('status_id', [6, 14]); // Solamente estados de alquiler

        if (!empty($this->filter_status_id)) {
            $alquileres_query->where('status_id', $this->filter_status_id);
        }

        $alquileres = $alquileres_query->orderBy('id', 'desc')->paginate(10);
        
        $statuses = Status::whereBetween('id', [6, 14])->get();

        // Products search for modal
        $catalog_products = [];
        if ($this->showProductsModal && strlen($this->search_product) > 0) {
            $catalog_products = CatalagoPrecio::with(['producto.color'])
                ->whereHas('producto', function($q) {
                    $q->where('nombre', 'like', '%'.$this->search_product.'%');
                })
                ->whereIn('status_id', [1, 2])
                ->take(10)
                ->get();
        }

        // Subitems list for the selected order in modal
        $order_products = [];
        if ($this->showProductsModal && $this->selected_order_id) {
            $order_products = AlquileresProducto::with(['catalogoPrecio.producto'])
                ->where('alquiler_id', $this->selected_order_id)
                ->get();
        }

        return view('livewire.admin.order.orders', compact('alquileres', 'statuses', 'catalog_products', 'order_products'));
    }

    // --- State Machine Actions ---

    public function validarCotizacion($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        if ($alquiler->status_id == 6) { // Cotización
            $alquiler->update(['status_id' => 7]); // Pendiente de pago
            $this->dispatch('swal:success', ['message' => 'Cotización validada. Pasó a Pendiente de Pago.']);
        }
    }

    public function validarRenta($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        if ($alquiler->status_id == 10) { // Pagado
            $alquiler->update(['status_id' => 11]); // Rentado
            $this->dispatch('swal:success', ['message' => 'Renta validada y en curso.']);
        }
    }

    public function finalizarRenta($id)
    {
        $alquiler = Alquiler::findOrFail($id);
        if ($alquiler->status_id == 11) { // Rentado
            $alquiler->update([
                'status_id' => 14, // Finalizado
                'fecha_finalizada' => now()
            ]);
            $this->dispatch('swal:success', ['message' => 'Alquiler finalizado correctamente.']);
        }
    }

    // --- PAYMENT MODAL ---

    public function openPaymentModal($id)
    {
        $this->selected_order_id = $id;
        $this->monto_a_pagar = '';
        $this->evidencia_pago = null;
        $this->showPaymentModal = true;
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
        $this->resetValidation();
    }

    public function processPayment()
    {
        $this->validate([
            'monto_a_pagar' => 'required|numeric|min:1',
            'evidencia_pago' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $alquiler = Alquiler::findOrFail($this->selected_order_id);
        
        $path = $alquiler->evidencia_pago;
        if ($this->evidencia_pago) {
            $path = Utility::saveFile($this->evidencia_pago, 'evidencias_pago');
        }

        $nuevo_monto = $alquiler->monto_pagado + $this->monto_a_pagar;
        $total = $alquiler->total ?: 0; // If total is not set yet, assume 0 or handle it
        
        // Ensure we don't divide by zero or logic fails if total isn't set.
        // Ideally total is calculated from assigned products
        
        $nuevo_status = $alquiler->status_id;
        if ($nuevo_monto >= $total && $total > 0) {
            $nuevo_status = 10; // Pagado
        } else {
            $nuevo_status = 9; // Anticipo
        }

        $alquiler->update([
            'monto_pagado' => $nuevo_monto,
            'evidencia_pago' => $path,
            'status_id' => $nuevo_status
        ]);

        $this->closePaymentModal();
        $this->dispatch('swal:success', ['message' => 'Pago registrado extosamente.']);
    }

    // --- CANCEL MODAL ---

    public function openCancelModal($id)
    {
        $this->selected_order_id = $id;
        $this->motivo_cancelacion = '';
        $this->showCancelModal = true;
    }

    public function closeCancelModal()
    {
        $this->showCancelModal = false;
        $this->resetValidation();
    }

    public function cancelOrder()
    {
        $this->validate([
            'motivo_cancelacion' => 'required|string|min:5'
        ]);

        $alquiler = Alquiler::findOrFail($this->selected_order_id);
        
        // If status is 11 (Rentado), it goes to 13 (Devuelto)
        // Others (6,7,9,10) go to 8 (Cancelado)
        $new_status = ($alquiler->status_id == 11) ? 13 : 8;

        $alquiler->update([
            'status_id' => $new_status,
            'motivo_cancelacion' => $this->motivo_cancelacion
        ]);

        $this->closeCancelModal();
        $this->dispatch('swal:success', ['message' => 'Orden cancelada/devuelta.']);
    }

    // --- PRODUCTS MODAL ---

    public function openProductsModal($id)
    {
        $this->selected_order_id = $id;
        $this->search_product = '';
        $this->selected_catalogo_precio_id = '';
        $this->cantidad_producto = 1;
        $this->showProductsModal = true;
    }

    public function closeProductsModal()
    {
        $this->showProductsModal = false;
        $this->resetValidation();
    }

    public function selectCatalogoPrecio($id)
    {
        $this->selected_catalogo_precio_id = $id;
    }

    public function addProductToOrder()
    {
        $this->validate([
            'selected_catalogo_precio_id' => 'required|exists:catalago_precios,id',
            'cantidad_producto' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $precio_catalog = CatalagoPrecio::findOrFail($this->selected_catalogo_precio_id);
            
            // Check if already exist
            $exist = AlquileresProducto::where('alquiler_id', $this->selected_order_id)
                        ->where('Catalogo_precio_id', $this->selected_catalogo_precio_id)
                        ->first();
            
            if ($exist) {
                $exist->increment('cantidad', $this->cantidad_producto);
            } else {
                AlquileresProducto::create([
                    'alquiler_id' => $this->selected_order_id,
                    'Catalogo_precio_id' => $this->selected_catalogo_precio_id,
                    'cantidad' => $this->cantidad_producto
                ]);
            }

            $this->recalculateTotal();

            DB::commit();
            
            // Reset fields
            $this->search_product = '';
            $this->selected_catalogo_precio_id = '';
            $this->cantidad_producto = 1;

            $this->dispatch('swal:success', ['message' => 'Producto agregado.']);
        } catch(\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al agregar producto: ' . $e->getMessage());
        }
    }

    public function removeProductFromOrder($id)
    {
        $item = AlquileresProducto::findOrFail($id);
        $item->delete();
        $this->recalculateTotal();
        $this->dispatch('swal:success', ['message' => 'Producto removido.']);
    }

    public function downloadTicket($id)
    {
        $alquiler = Alquiler::with([
            'cliente.persona', 
            'cliente.telefonos', 
            'status', 
            'productos.catalogoPrecio.producto', 
            'metodoPago'
        ])->findOrFail($id);

        $catalago_cliente = \App\Models\CatalagoCliente::with('direccion.colonia')
            ->find($alquiler->direcciónes_clientes_id);

        $html = view('livewire.admin.order.ticket', [
            'alquiler' => $alquiler,
            'catalago_cliente' => $catalago_cliente
        ])->render();

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        
        // 80mm = ~226.77 points. Long height for thermal roll.
        $customPaper = array(0, 0, 226.77, 841.89);
        $dompdf->setPaper($customPaper);
        
        $dompdf->render();

        return response()->streamDownload(function () use ($dompdf) {
            echo $dompdf->output();
        }, 'Ticket_Orden_' . $alquiler->id . '.pdf');
    }

    private function recalculateTotal()
    {
        if ($this->selected_order_id) {
            $items = AlquileresProducto::with('catalogoPrecio')->where('alquiler_id', $this->selected_order_id)->get();
            $total = 0;
            foreach ($items as $item) {
                if ($item->catalogoPrecio) {
                    $total += ($item->cantidad * $item->catalogoPrecio->precio);
                }
            }
            Alquiler::where('id', $this->selected_order_id)->update(['total' => $total]);
        }
    }
}
