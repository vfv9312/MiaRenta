<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Person;
use App\Models\Direccion;
use App\Models\CatalagoCliente;
use App\Models\Colonia;
use App\Models\MetodoPago;
use App\Models\Status;
use App\Models\CatalagoPrecio;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    // Client selection
    public $cliente_id = '';
    public $search_cliente = '';

    // New Client form
    public $is_new_client = false;
    public $nombre = '';
    public $apellido = '';
    public $correo = '';
    public $telefono = '';

    // Address selection
    public $catalogo_cliente_id = '';

    // New Address form
    public $is_new_address = false;
    public $colonia_id = '';
    public $search_colonia = '';
    public $selected_colonia_name = '';
    public $calle = '';
    public $entre_calles = '';
    public $referencia = '';
    public $cp = '';

    // Products (Cotizador)
    public $search_producto = '';
    public $selected_catalogo_precio_id = '';
    public $cantidad_producto = 1;
    public $carrito_productos = [];

    // Additional Costs
    public $costos_adicionales = [];

    // Rental data
    public $metodo_pago_id = '';
    public $recibe = '';
    public $entrega = '';
    public $fecha_solicitada = '';
    public $fecha_entrega = '';
    public $fecha_recepcion = '';

    public function getDiasAlquilerProperty()
    {
        $dias = 1;
        if ($this->fecha_entrega && $this->fecha_recepcion) {
            try {
                $f_inicio = \Carbon\Carbon::parse($this->fecha_entrega)->startOfDay();
                $f_fin = \Carbon\Carbon::parse($this->fecha_recepcion)->startOfDay();
                
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
        return $dias;
    }

    public function render()
    {
        $clientes = Cliente::with(['persona', 'telefonos'])
            ->whereHas('persona', function ($query) {
                $query->where('nombre', 'like', '%' . $this->search_cliente . '%')
                    ->orWhere('apellido', 'like', '%' . $this->search_cliente . '%');
            })
            ->orWhereHas('telefonos', function ($query) {
                $query->where('telefono', 'like', '%' . $this->search_cliente . '%');
            })
            ->orWhere('correo', 'like', '%' . $this->search_cliente . '%')
            ->take(10)
            ->get();

        $direcciones_cliente = [];
        if ($this->cliente_id) {
            $direcciones_cliente = CatalagoCliente::with(['direccion.colonia'])
                ->where('cliente_id', $this->cliente_id)
                ->whereIn('status_id', [1, 2])
                ->get();
        }

        $catalog_products = [];
        if (strlen($this->search_producto) > 0) {
            $catalog_products = CatalagoPrecio::with(['producto.color', 'producto.reparaciones'])
                ->whereHas('producto', function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search_producto . '%');
                })
                ->whereIn('status_id', [1, 2])
                ->take(10)
                ->get();

            if ($this->fecha_entrega) {
                $f_inicio = date('Y-m-d', strtotime($this->fecha_entrega));
                $f_fin = $this->fecha_recepcion ? date('Y-m-d', strtotime($this->fecha_recepcion)) : $f_inicio;

                foreach ($catalog_products as $cp) {
                    $rentados = \Illuminate\Support\Facades\DB::table('alquileres_productos')
                        ->join('alquileres', 'alquileres_productos.alquiler_id', '=', 'alquileres.id')
                        ->where('alquileres_productos.Catalogo_precio_id', $cp->id)
                        ->whereIn('alquileres.status_id', [7, 9, 10, 11, 12])
                        ->where(function ($query) use ($f_inicio, $f_fin) {
                            $query->whereDate('alquileres.fecha_entrega', '<=', $f_fin)
                                ->whereDate('alquileres.fecha_recepcion', '>=', $f_inicio);
                        })
                        ->sum('alquileres_productos.cantidad');

                    $cp->en_renta_calculado = $rentados;
                }
            } else {
                foreach ($catalog_products as $cp) {
                    $cp->en_renta_calculado = 0;
                }
            }
        }

        $colonias = [];
        if (strlen($this->search_colonia) >= 2) {
            $colonias = Colonia::where('localidad', 'like', '%' . $this->search_colonia . '%')
                ->orWhere('municipio', 'like', '%' . $this->search_colonia . '%')
                ->orWhere('cp', 'like', '%' . $this->search_colonia . '%')
                ->take(15)
                ->get();
        }

        $metodos_pago = MetodoPago::whereIn('status_id', [1, 2])->get();

        return view('livewire.admin.order.index', compact('clientes', 'direcciones_cliente', 'catalog_products', 'colonias', 'metodos_pago'));
    }

    public function selectColonia($id, $name)
    {
        $this->colonia_id = $id;
        $this->selected_colonia_name = $name;
        $this->search_colonia = '';
    }

    public function selectCliente($id)
    {
        $this->cliente_id = $id;
        $this->is_new_client = false;
        $this->catalogo_cliente_id = '';
    }

    public function toggleNewClient()
    {
        $this->is_new_client = !$this->is_new_client;
        if ($this->is_new_client) {
            $this->cliente_id = '';
            $this->catalogo_cliente_id = '';
            $this->search_cliente = '';
        }
    }

    public function toggleNewAddress()
    {
        $this->is_new_address = !$this->is_new_address;
        if ($this->is_new_address) {
            $this->catalogo_cliente_id = '';
        }
    }

    public function selectCatalogoPrecio($id)
    {
        $this->selected_catalogo_precio_id = $id;
    }

    public function addProductToCart()
    {
        $this->validate([
            'selected_catalogo_precio_id' => 'required|exists:catalago_precios,id',
            'cantidad_producto' => 'required|integer|min:1'
        ]);

        if (!$this->fecha_entrega) {
            $this->addError('cantidad_producto', 'Falta Fecha de Entrega Física asignada en el paso anterior.');
            return;
        }

        $item = CatalagoPrecio::with(['producto.color', 'producto.reparaciones'])->findOrFail($this->selected_catalogo_precio_id);

        $en_reparacion = $item->producto->reparaciones->where('status_id', 5)->sum('cantidad');

        $f_inicio = date('Y-m-d', strtotime($this->fecha_entrega));
        $f_fin = $this->fecha_recepcion ? date('Y-m-d', strtotime($this->fecha_recepcion)) : $f_inicio;

        $en_renta = \Illuminate\Support\Facades\DB::table('alquileres_productos')
            ->join('alquileres', 'alquileres_productos.alquiler_id', '=', 'alquileres.id')
            ->where('alquileres_productos.Catalogo_precio_id', $item->id)
            ->whereIn('alquileres.status_id', [7, 9, 10, 11, 12])
            ->where(function ($query) use ($f_inicio, $f_fin) {
                $query->whereDate('alquileres.fecha_entrega', '<=', $f_fin)
                    ->whereDate('alquileres.fecha_recepcion', '>=', $f_inicio);
            })
            ->sum('alquileres_productos.cantidad');

        $disponible = $item->producto->cantidad - $en_reparacion - $en_renta;

        $exists = false;
        $current_index = -1;
        $current_in_cart = 0;

        foreach ($this->carrito_productos as $key => $cart_item) {
            if ($cart_item['catalago_precio_id'] == $item->id) {
                $current_in_cart = $cart_item['cantidad'];
                $exists = true;
                $current_index = $key;
                break;
            }
        }

        if (($current_in_cart + $this->cantidad_producto) > $disponible) {
            $this->addError('cantidad_producto', 'Solo hay ' . $disponible . ' unidades libres para esta fecha (Reparación: ' . $en_reparacion . ', En Renta: ' . $en_renta . ').');
            return;
        }

        if ($exists) {
            $this->carrito_productos[$current_index]['cantidad'] += $this->cantidad_producto;
        } else {
            $this->carrito_productos[] = [
                'catalago_precio_id' => $item->id,
                'nombre' => $item->producto->nombre ?? 'Desconocido',
                'color' => $item->producto->color->nombre ?? '',
                'precio' => $item->precio,
                'cantidad' => $this->cantidad_producto,
            ];
        }

        $this->search_producto = '';
        $this->selected_catalogo_precio_id = '';
        $this->cantidad_producto = 1;

        $this->dispatch('swal:success', ['message' => 'Mobiliario agregado a la cotización.']);
    }

    public function removeProductFromCart($index)
    {
        if (isset($this->carrito_productos[$index])) {
            unset($this->carrito_productos[$index]);
            $this->carrito_productos = array_values($this->carrito_productos);
        }
    }

    public function addCostoAdicional()
    {
        $this->costos_adicionales[] = [
            'concepto' => '',
            'monto' => 0
        ];
    }

    public function removeCostoAdicional($index)
    {
        if (isset($this->costos_adicionales[$index])) {
            unset($this->costos_adicionales[$index]);
            $this->costos_adicionales = array_values($this->costos_adicionales);
        }
    }

    public function submitOrder()
    {
        $this->validate([
            'recibe' => 'required|string|max:255',
            'entrega' => 'required|string|max:255',
            'metodo_pago_id' => 'required|exists:metodos_pagos,id',
            'fecha_solicitada' => 'required|date',
            'carrito_productos' => 'required|array|min:1', // Needs at least one product
            'costos_adicionales.*.concepto' => 'required|string|max:255',
            'costos_adicionales.*.monto' => 'required|numeric|min:0',
        ], [
            'carrito_productos.required' => 'Debe agregar al menos un producto a la orden.',
            'costos_adicionales.*.concepto.required' => 'El concepto del costo adicional es requerido.',
            'costos_adicionales.*.monto.required' => 'El monto del costo adicional es requerido.',
            'costos_adicionales.*.monto.numeric' => 'El monto debe ser un número válido.'
        ]);

        if ($this->is_new_client) {
            $this->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'telefono' => 'required|string|max:20',
                'correo' => 'nullable|email|max:255',
            ]);
        } elseif (!$this->cliente_id) {
            session()->flash('error', 'Debe seleccionar o crear un cliente.');
            return;
        }

        if ($this->is_new_address || $this->is_new_client) {
            $this->validate([
                'colonia_id' => 'required|exists:colonias,id',
                'calle' => 'required|string|max:255',
                'entre_calles' => 'required|string|max:255',
                'cp' => 'nullable|integer',
            ]);
        } elseif (!$this->catalogo_cliente_id) {
            session()->flash('error', 'Debe seleccionar o crear una dirección para el cliente.');
            return;
        }

        DB::beginTransaction();

        try {
            $cliente_final_id = $this->cliente_id;

            if ($this->is_new_client) {
                $person = Person::create([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                ]);

                $cliente = Cliente::create([
                    'persona_id' => $person->id,
                    'status_id' => 1,
                    'correo' => $this->correo ?: null,
                ]);
                $cliente_final_id = $cliente->id;

                DB::table('telefonos_clientes')->insert([
                    'cliente_id' => $cliente_final_id,
                    'status_id' => 1,
                    'telefono' => $this->telefono,
                    'tipo' => 'whatsapp',
                    'prioridad' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $catalago_final_id = $this->catalogo_cliente_id;

            if ($this->is_new_address || $this->is_new_client) {
                $direccion = Direccion::create([
                    'colonias_id' => $this->colonia_id,
                    'status_id' => 1,
                    'calle' => $this->calle,
                    'entre_calles' => $this->entre_calles,
                    'referencia' => $this->referencia,
                    'cp' => $this->cp ?: null,
                ]);

                $catalago_cliente = CatalagoCliente::create([
                    'direccion_id' => $direccion->id,
                    'cliente_id' => $cliente_final_id,
                    'status_id' => 1,
                    'prioridad' => 1,
                ]);

                $catalago_final_id = $catalago_cliente->id;
            }

            // Look up the status ID for 'Cotizacion'
            $status = Status::where('name', 'Cotizacion')
                ->orWhere('name', 'Cotización')
                ->first();

            if (!$status) {
                $status = Status::where('order', 6)->first();
            }

            if (!$status) {
                throw new \Exception("No se encontró el estado 'Cotizacion' (ID 6).");
            }

            $final_status_id = $status->id;

            $dias = $this->dias_alquiler;

            // Calculate total before creating alquileres
            $total_orden = 0;
            foreach ($this->carrito_productos as $item) {
                $total_orden += ($item['precio'] * $item['cantidad'] * $dias);
            }

            foreach ($this->costos_adicionales as $costo) {
                $total_orden += (float) $costo['monto'];
            }

            // Create Alquiler (Rental)
            $alquiler_id = DB::table('alquileres')->insertGetId([
                'cliente_id' => $cliente_final_id,
                'direcciónes_clientes_id' => $catalago_final_id,
                'status_id' => $final_status_id,
                'metodo_pago_id' => $this->metodo_pago_id,
                'recibe' => $this->recibe,
                'entrega' => $this->entrega,
                'fecha_solicitada' => $this->fecha_solicitada,
                'fecha_entrega' => $this->fecha_entrega ?: null,
                'fecha_recepcion' => $this->fecha_recepcion ?: null,
                'total' => $total_orden,
                'costos_adicionales' => json_encode($this->costos_adicionales),
                'monto_pagado' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Save products
            foreach ($this->carrito_productos as $item) {
                DB::table('alquileres_productos')->insert([
                    'alquiler_id' => $alquiler_id,
                    'Catalogo_precio_id' => $item['catalago_precio_id'],
                    'cantidad' => $item['cantidad'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            session()->flash('message', 'Orden #' . $alquiler_id . ' registrada exitosamente. Total a pagar: $' . number_format($total_orden, 2));

            // Reset form
            $this->reset(['is_new_client', 'is_new_address', 'cliente_id', 'catalogo_cliente_id', 'nombre', 'apellido', 'correo', 'calle', 'entre_calles', 'referencia', 'cp', 'colonia_id', 'search_colonia', 'selected_colonia_name', 'recibe', 'entrega', 'fecha_solicitada', 'fecha_entrega', 'fecha_recepcion', 'metodo_pago_id', 'search_cliente', 'search_producto', 'selected_catalogo_precio_id', 'cantidad_producto', 'carrito_productos', 'costos_adicionales']);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al crear la orden: ' . $e->getMessage());
        }
    }
}
