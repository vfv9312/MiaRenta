<?php

namespace App\Livewire\Admin\Inventary;

use App\Models\Producto;
use App\Models\Color;
use App\Models\CatalogoTipo;
use App\Models\CatalagoPrecio;
use App\Models\CatalagoTipo;
use App\Models\Categorias;
use App\Models\Tipo;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;

    public $item_id, $nombre, $cantidad, $descripcion, $prioridad, $categoria_id, $tipo_id, $color_id, $precio;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'cantidad' => 'required|integer|min:0',
        'descripcion' => 'required|string',
        'prioridad' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'tipo_id' => 'required|exists:tipos,id',
        'color_id' => 'required|exists:colores,id',
        'precio' => 'required|numeric|min:0',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Producto::with(['color', 'catalogoTipo.categoria', 'catalogoTipo.tipo', 'precioActivo'])
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->whereIn('status_id', [1, 2])
            ->latest()
            ->paginate(10);

        $colors = Color::whereIn('status_id', [1, 2])->get();
        $categorias = Categorias::whereIn('status_id', [1, 2])->get();
        $tipos = Tipo::whereIn('status_id', [1, 2])->get();

        return view('livewire.admin.inventary.products', compact('products', 'colors', 'categorias', 'tipos'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    private function resetInputFields()
    {
        $this->item_id = null;
        $this->nombre = '';
        $this->cantidad = '';
        $this->descripcion = '';
        $this->prioridad = '';
        $this->categoria_id = '';
        $this->tipo_id = '';
        $this->color_id = '';
        $this->precio = '';
    }

    public function store()
    {
        $this->validate();

        // Resolve Catalogo Tipo
        $catalogoTipo = CatalagoTipo::firstOrCreate([
            'categoria_id' => $this->categoria_id,
            'tipo_id' => $this->tipo_id,
        ], [
            'status_id' => 1
        ]);

        $producto = Producto::updateOrCreate(
            ['id' => $this->item_id],
            [
                'nombre' => $this->nombre,
                'cantidad' => $this->cantidad,
                'descripcion' => $this->descripcion,
                'prioridad' => $this->prioridad,
                'catalogo_tipo_id' => $catalogoTipo->id,
                'color_id' => $this->color_id,
                'status_id' => 1
            ]
        );

        // Handle Price logic
        if ($this->item_id) {
            $currentActivePrice = $producto->precioActivo;
            // If there's an active price and it's different from context, update old to 2 and create new 1
            if ($currentActivePrice && $currentActivePrice->precio != $this->precio) {
                $currentActivePrice->update(['status_id' => 2]);
                CatalagoPrecio::create([
                    'producto_id' => $producto->id,
                    'precio' => $this->precio,
                    'status_id' => 1
                ]);
            } elseif (!$currentActivePrice) {
                // Should not happen, but fallback
                CatalagoPrecio::create([
                    'producto_id' => $producto->id,
                    'precio' => $this->precio,
                    'status_id' => 1
                ]);
            }
        } else {
            // New Product
            CatalagoPrecio::create([
                'producto_id' => $producto->id,
                'precio' => $this->precio,
                'status_id' => 1
            ]);
        }

        session()->flash('message', $this->item_id ? 'Producto actualizado correctamente.' : 'Producto creado correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Producto::findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $product->nombre;
        $this->cantidad = $product->cantidad;
        $this->descripcion = $product->descripcion;
        $this->prioridad = $product->prioridad;
        if ($product->catalogoTipo) {
            $this->categoria_id = $product->catalogoTipo->categoria_id;
            $this->tipo_id = $product->catalogoTipo->tipo_id;
        }
        $this->color_id = $product->color_id;
        $this->precio = $product->precioActivo ? $product->precioActivo->precio : '';

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $product = Producto::findOrFail($this->item_id);
        $product->update(['status_id' => 3]);
        CatalagoPrecio::where('producto_id', $product->id)->update(['status_id' => 3]);
        
        session()->flash('message', 'Producto eliminado correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
