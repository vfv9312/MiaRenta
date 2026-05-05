<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categorias;

class ListaProductos extends Component
{
    public $search = '';
    public $category = 'todos';
    public $cart = [];
    public $allCategories = [];

    public $showCheckout = false;
    public $direccion = '';
    public $fecha_hora = '';
    public $nombre = '';
    public $celular = '';
    public $metodo_pago = '';
    public $dias_renta = 1;
    public $isCartExpanded = false;

    protected $rules = [
        'direccion'    => 'required|string',
        'fecha_hora'   => 'required|string',
        'nombre'       => 'required|string',
        'celular'      => 'nullable|string',
        'metodo_pago'  => 'required|string|in:efectivo,transferencia,terminal',
        'dias_renta'   => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->allCategories = Categorias::where('status_id', 1)->get();
    }

    public function addToCart($productId)
    {
        $product = Producto::with('precioActivo')->find($productId);
        if (!$product || !$product->precioActivo) return;

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'name' => $product->nombre,
                'price' => $product->precioActivo->precio,
                'quantity' => 1
            ];
        }
    }

    public function removeFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
            } else {
                unset($this->cart[$productId]);
            }
        }
    }

    public function getTotalProperty()
    {
        $dias = max(1, (int) $this->dias_renta);
        return collect($this->cart)->reduce(function ($total, $item) use ($dias) {
            return $total + ($item['price'] * $item['quantity'] * $dias);
        }, 0);
    }
    
    public $showImagePreview = false;
    public $previewImages = [];

    public function openImagePreview()
    {
        $this->previewImages = [];
        $productIds = collect($this->cart)->keys()->toArray();
        if (empty($productIds)) return;

        // Obtenemos todas las combinaciones que tienen alguno de estos productos
        $combinacionesInCart = \Illuminate\Support\Facades\DB::table('combinacion_producto')
            ->whereIn('producto_id', $productIds)
            ->pluck('combinacion_id')
            ->unique();
                
        // Filtramos solo aquellas combinaciones donde TODOS sus productos están el carrito
        $validCombIds = [];
        foreach($combinacionesInCart as $cId) {
            $combProducts = \Illuminate\Support\Facades\DB::table('combinacion_producto')
                ->where('combinacion_id', $cId)
                ->pluck('producto_id')
                ->toArray();
                
            $hasAll = true;
            foreach($combProducts as $cp) {
                if(!in_array($cp, $productIds)) { 
                    $hasAll = false; 
                    break; 
                }
            }
            if($hasAll) {
                $validCombIds[] = $cId;
            }
        }

        $combImages = [];
        if(count($validCombIds) > 0) {
            $combImages = \Illuminate\Support\Facades\DB::table('catalogo_imagines')
                ->whereIn('combinacion_id', $validCombIds)
                ->whereNotNull('imagen')
                ->orderBy('id', 'desc')
                ->pluck('imagen')->toArray();
        }

        // También mostramos las imágenes individuales de los productos
        $productImages = \Illuminate\Support\Facades\DB::table('catalogo_imagines')
            ->whereIn('producto_id', $productIds)
            ->whereNotNull('imagen')
            ->orderBy('id', 'desc')
            ->pluck('imagen')->toArray();

        // Unimos y removemos duplicados
        $todas = array_unique(array_merge($combImages, $productImages));
        
        $this->previewImages = array_filter($todas);
        $this->showImagePreview = true;
    }

    public function closeImagePreview()
    {
        $this->showImagePreview = false;
    }

    public function openCheckout()
    {
        $this->showCheckout = true;
    }
    
    public function closeCheckout()
    {
        $this->showCheckout = false;
        $this->resetValidation();
    }

    public function incrementDias()
    {
        $this->dias_renta++;
    }

    public function decrementDias()
    {
        if ($this->dias_renta > 1) {
            $this->dias_renta--;
        }
    }

    public function processOrder()
    {
        $this->validate();

        $dias  = max(1, (int) $this->dias_renta);
        $items = collect($this->cart)->map(fn($item) => "{$item['quantity']}x {$item['name']} (c/u $" . number_format($item['price'], 2) . ")")->implode(', ');
        $total = number_format($this->total, 2);
        
        $message = "Hola MiaRenta, me gustaría armar este pedido:\n\n";
        $message .= "*Cliente:* {$this->nombre}\n";
        $message .= "*Dirección:* {$this->direccion}\n";
        $message .= "*Fecha y hora:* {$this->fecha_hora}\n";
        $message .= "*Días de renta:* {$dias} " . ($dias === 1 ? 'día' : 'días') . "\n";
        if (!empty($this->celular)) {
            $message .= "*Celular alternativo:* {$this->celular}\n";
        }
        $message .= "*Método de pago:* " . ucfirst($this->metodo_pago) . "\n";
        $message .= "\n*Paquete:*\n{$items}\n\n";
        $message .= "*Total estimado ({$dias} " . ($dias === 1 ? 'día' : 'días') . ":* $" . $total;

        $detalleWp = \Illuminate\Support\Facades\DB::table('_detalles_contacto')
            ->join('contactos_data_tipos', '_detalles_contacto.contacto_data_tipo_id', '=', 'contactos_data_tipos.id')
            ->where('contactos_data_tipos.nombre', 'like', '%WhatsApp%')
            ->first();

        // Limpiar el número y poner uno por defecto si no lo encuentra en DB
        $numeroWhatsapp = $detalleWp ? preg_replace('/[^0-9]/', '', $detalleWp->recurso) : '9614585559';

        $url = "https://wa.me/{$numeroWhatsapp}?text=" . urlencode($message);

        $this->cart = [];
        $this->showCheckout = false;
        $this->reset(['direccion', 'fecha_hora', 'nombre', 'celular', 'metodo_pago', 'dias_renta']);
        $this->dias_renta = 1;
        
        $this->dispatch('openUrl', ['url' => $url]);
    }

    public function render()
    {
        $query = Producto::with(['precioActivo', 'imagenes', 'catalogoTipo.categoria'])
            ->where('status_id', 1)
            ->whereHas('precioActivo');

        if ($this->category !== 'todos') {
            $query->whereHas('catalogoTipo.categoria', function($q) {
                $q->where('id', $this->category);
            });
        }

        if (!empty($this->search)) {
            $query->where('nombre', 'like', '%'.$this->search.'%');
        }

        $filteredProducts = $query->get()->map(function($p) {
            $imageUrl = $p->imagenes->first() ? asset($p->imagenes->first()->imagen) : null;
            return [
                'id' => $p->id,
                'name' => $p->nombre,
                'price' => $p->precioActivo->precio,
                'category' => $p->catalogoTipo->categoria->nombre ?? 'Sin categoría',
                'image' => $imageUrl,
            ];
        });

        return view('livewire.dashboard.lista-productos', [
            'filteredProducts' => $filteredProducts
        ]);
    }
}
