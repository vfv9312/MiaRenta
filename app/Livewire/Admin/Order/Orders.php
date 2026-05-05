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
    public $showDetailsModal = false;
    public $showEditModal = false;

    // Selected order
    public $selected_order_id = null;
    public $selected_order = null;
    public $selected_order_status_id = null;
    public $modal_dias_alquiler = 1;
    
    // Edit Order Form
    public $edit_fecha_entrega = '';
    public $edit_fecha_recepcion = '';
    public $edit_catalogo_cliente_id = '';
    public $edit_direcciones = [];
    
    // Cancel Form
    public $motivo_cancelacion = '';

    // Payment Form
    public $monto_a_pagar = '';
    public $evidencia_pago; // file upload

    // Products Form
    public $search_product = '';
    public $selected_catalogo_precio_id = '';
    public $cantidad_producto = 1;
    public $cart_products = [];

    // Extra Costs Form in Modal
    public $new_costo_concepto = '';
    public $new_costo_monto = '';
    public $order_costos_adicionales = [];

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

        return view('livewire.admin.order.orders', compact('alquileres', 'statuses', 'catalog_products'));
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
        
        $order = Alquiler::find($id);
        $this->selected_order_status_id = $order->status_id;
        $this->modal_dias_alquiler = 1;
        if ($order && $order->fecha_entrega && $order->fecha_recepcion) {
            try {
                $f_inicio = \Carbon\Carbon::parse($order->fecha_entrega)->startOfDay();
                $f_fin = \Carbon\Carbon::parse($order->fecha_recepcion)->startOfDay();
                if ($f_fin->lt($f_inicio)) {
                    $this->modal_dias_alquiler = 1;
                } else {
                    $dias_diff = $f_inicio->diffInDays($f_fin);
                    $this->modal_dias_alquiler = $dias_diff == 0 ? 1 : $dias_diff;
                }
            } catch (\Exception $e) {}
        }

        $this->search_product = '';
        $this->selected_catalogo_precio_id = '';
        $this->cantidad_producto = 1;
        $this->new_costo_concepto = '';
        $this->new_costo_monto = '';
        
        $this->order_costos_adicionales = $order->costos_adicionales ? json_decode($order->costos_adicionales, true) : [];
        if (!is_array($this->order_costos_adicionales)) {
            $this->order_costos_adicionales = [];
        }

        $this->cart_products = [];
        $db_products = AlquileresProducto::with('catalogoPrecio.producto')->where('alquiler_id', $id)->get();
        foreach($db_products as $op) {
            $this->cart_products[] = [
                'catalogo_precio_id' => $op->Catalogo_precio_id,
                'nombre' => $op->catalogoPrecio->producto->nombre ?? 'Desconocido',
                'precio' => $op->catalogoPrecio->precio ?? 0,
                'cantidad' => $op->cantidad
            ];
        }

        $this->showProductsModal = true;
    }

    public function closeProductsModal()
    {
        $this->showProductsModal = false;
        $this->resetValidation();
    }

    // --- DETAILS MODAL ---

    public function openDetailsModal($id)
    {
        $this->selected_order = Alquiler::with([
            'cliente.persona', 
            'cliente.telefonos', 
            'status', 
            'productos.catalogoPrecio.producto.color', 
            'metodoPago'
        ])->findOrFail($id);
        
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selected_order = null;
    }

    // --- EDIT MODAL ---

    public function openEditModal($id)
    {
        $this->selected_order_id = $id;
        $order = Alquiler::findOrFail($id);
        
        $this->edit_fecha_entrega = $order->fecha_entrega ? \Carbon\Carbon::parse($order->fecha_entrega)->format('Y-m-d\TH:i') : null;
        $this->edit_fecha_recepcion = $order->fecha_recepcion ? \Carbon\Carbon::parse($order->fecha_recepcion)->format('Y-m-d\TH:i') : null;
        $this->edit_catalogo_cliente_id = $order->direcciónes_clientes_id;

        $this->edit_direcciones = \App\Models\CatalagoCliente::with('direccion.colonia')
            ->where('cliente_id', $order->cliente_id)
            ->whereIn('status_id', [1, 2])
            ->get();

        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->resetValidation();
    }

    public function updateOrder()
    {
        $this->validate([
            'edit_fecha_entrega' => 'required|date',
            'edit_fecha_recepcion' => 'required|date',
            'edit_catalogo_cliente_id' => 'required|exists:catalago_clientes,id'
        ]);

        $order = Alquiler::findOrFail($this->selected_order_id);

        $order->update([
            'fecha_entrega' => $this->edit_fecha_entrega,
            'fecha_recepcion' => $this->edit_fecha_recepcion,
            'direcciónes_clientes_id' => $this->edit_catalogo_cliente_id
        ]);

        $this->recalculateTotal();

        $this->closeEditModal();
        $this->dispatch('swal:success', ['message' => 'Orden actualizada exitosamente.']);
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

        $precio_catalog = CatalagoPrecio::with('producto')->findOrFail($this->selected_catalogo_precio_id);
        
        $exist = false;
        foreach($this->cart_products as $key => $item) {
            if($item['catalogo_precio_id'] == $this->selected_catalogo_precio_id) {
                $this->cart_products[$key]['cantidad'] += $this->cantidad_producto;
                $exist = true;
                break;
            }
        }
        
        if(!$exist) {
            $this->cart_products[] = [
                'catalogo_precio_id' => $this->selected_catalogo_precio_id,
                'nombre' => $precio_catalog->producto->nombre ?? 'Desconocido',
                'precio' => $precio_catalog->precio ?? 0,
                'cantidad' => $this->cantidad_producto
            ];
        }

        $this->search_product = '';
        $this->selected_catalogo_precio_id = '';
        $this->cantidad_producto = 1;
    }

    public function removeProductFromOrder($index)
    {
        if(isset($this->cart_products[$index])) {
            unset($this->cart_products[$index]);
            $this->cart_products = array_values($this->cart_products);
        }
    }

    public function addCostoAdicionalToOrder()
    {
        $this->validate([
            'new_costo_concepto' => 'required|string|max:255',
            'new_costo_monto' => 'required|numeric|min:0'
        ]);

        $this->order_costos_adicionales[] = [
            'concepto' => $this->new_costo_concepto,
            'monto' => $this->new_costo_monto
        ];

        $this->new_costo_concepto = '';
        $this->new_costo_monto = '';
    }

    public function removeCostoAdicionalFromOrder($index)
    {
        if (isset($this->order_costos_adicionales[$index])) {
            unset($this->order_costos_adicionales[$index]);
            $this->order_costos_adicionales = array_values($this->order_costos_adicionales);
        }
    }

    public function saveProductsAndCosts()
    {
        DB::beginTransaction();
        try {
            AlquileresProducto::where('alquiler_id', $this->selected_order_id)->delete();
            
            foreach($this->cart_products as $item) {
                AlquileresProducto::create([
                    'alquiler_id' => $this->selected_order_id,
                    'Catalogo_precio_id' => $item['catalogo_precio_id'],
                    'cantidad' => $item['cantidad']
                ]);
            }
            
            $order = Alquiler::findOrFail($this->selected_order_id);
            $order->update(['costos_adicionales' => json_encode($this->order_costos_adicionales)]);
            
            $this->recalculateTotal();
            
            DB::commit();
            $this->closeProductsModal();
            $this->dispatch('swal:success', ['message' => 'Mobiliario y costos actualizados exitosamente.']);
        } catch(\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al guardar los cambios: ' . $e->getMessage());
        }
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
        
        // 58mm = ~164.41 points. Long height for thermal roll.
        $customPaper = array(0, 0, 164.41, 841.89);
        $dompdf->setPaper($customPaper);
        
        $dompdf->render();

        return response()->streamDownload(function () use ($dompdf) {
            echo $dompdf->output();
        }, 'Ticket_Orden_' . $alquiler->id . '.pdf');
    }

    private function recalculateTotal()
    {
        if ($this->selected_order_id) {
            $order = Alquiler::find($this->selected_order_id);
            if (!$order) return;

            $dias = 1;
            if ($order->fecha_entrega && $order->fecha_recepcion) {
                try {
                    $f_inicio = \Carbon\Carbon::parse($order->fecha_entrega)->startOfDay();
                    $f_fin = \Carbon\Carbon::parse($order->fecha_recepcion)->startOfDay();
                    
                    if ($f_fin->lt($f_inicio)) {
                        $dias = 1;
                    } else {
                        $dias_diff = $f_inicio->diffInDays($f_fin);
                        $dias = $dias_diff == 0 ? 1 : $dias_diff;
                    }
                } catch (\Exception $e) {
                    $dias = 1;
                }
            }

            $items = AlquileresProducto::with('catalogoPrecio')->where('alquiler_id', $this->selected_order_id)->get();
            $total = 0;
            foreach ($items as $item) {
                if ($item->catalogoPrecio) {
                    $total += ($item->cantidad * $item->catalogoPrecio->precio * $dias);
                }
            }

            $costos = $order->costos_adicionales ? json_decode($order->costos_adicionales, true) : [];
            if (is_array($costos)) {
                foreach ($costos as $costo) {
                    $total += (float)($costo['monto'] ?? 0);
                }
            }

            $order->update(['total' => $total]);
        }
    }
}
