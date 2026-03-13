<?php

namespace App\Livewire\Admin\Inventary;

use App\Models\CatalogoImagen;
use App\Models\Combinacion;
use App\Models\Producto;
use App\Helpers\Utility;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Images extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $imagen, $item_id;
    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;

    // Type of upload: 'producto' or 'combinacion'
    public $tipo_imagen = 'producto';
    public $producto_id = '';

    // Combination fields
    public $combinacion_nombre = '';
    public $combinacion_descripcion = '';
    public $selectedProductos = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $images = CatalogoImagen::with(['producto', 'combinacion.productos'])
            ->whereIn('status_id', [1, 2])
            ->where(function ($query) {
                $query->whereHas('producto', function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('combinacion', function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(12);

        $productos = Producto::whereIn('status_id', [1, 2])->orderBy('nombre')->get();

        return view('livewire.admin.inventary.images', compact('images', 'productos'));
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
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->tipo_imagen = 'producto';
        $this->producto_id = '';
        $this->imagen = null;
        $this->item_id = null;
        $this->combinacion_nombre = '';
        $this->combinacion_descripcion = '';
        $this->selectedProductos = [];
    }

    public function store()
    {
        if ($this->tipo_imagen === 'producto') {
            $rules = [
                'producto_id' => 'required|exists:productos,id',
                'imagen' => $this->item_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            ];
        } else {
            $rules = [
                'combinacion_nombre' => 'required|string|max:255',
                'selectedProductos' => 'required|array|min:2',
                'selectedProductos.*' => 'exists:productos,id',
                'imagen' => $this->item_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
            ];
        }

        $this->validate($rules);

        $imagePath = null;
        if ($this->imagen) {
            $imagePath = Utility::saveFile($this->imagen, 'productos/imagenes');
        }

        if ($this->tipo_imagen === 'producto') {
            // Save individual product image
            CatalogoImagen::updateOrCreate(
                ['id' => $this->item_id],
                [
                    'producto_id' => $this->producto_id,
                    'combinacion_id' => null,
                    'imagen' => $imagePath ?? CatalogoImagen::find($this->item_id)?->imagen,
                    'status_id' => 1,
                ]
            );
        } else {
            // Create or update the combination
            $combinacion = Combinacion::create([
                'nombre' => $this->combinacion_nombre,
                'descripcion' => $this->combinacion_descripcion,
                'status_id' => 1,
            ]);

            // Attach products to the combination
            $combinacion->productos()->sync($this->selectedProductos);

            // Save image linked to the combination
            CatalogoImagen::create([
                'producto_id' => null,
                'combinacion_id' => $combinacion->id,
                'imagen' => $imagePath,
                'status_id' => 1,
            ]);
        }

        session()->flash('message', $this->item_id ? 'Imagen actualizada correctamente.' : 'Imagen subida correctamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $image = CatalogoImagen::findOrFail($id);
        $this->item_id = $id;

        if ($image->producto_id) {
            $this->tipo_imagen = 'producto';
            $this->producto_id = $image->producto_id;
        } else {
            $this->tipo_imagen = 'combinacion';
            $this->combinacion_nombre = $image->combinacion->nombre ?? '';
            $this->combinacion_descripcion = $image->combinacion->descripcion ?? '';
            $this->selectedProductos = $image->combinacion->productos->pluck('id')->toArray();
        }

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $image = CatalogoImagen::findOrFail($this->item_id);
        $image->update(['status_id' => 3]);

        session()->flash('message', 'Imagen eliminada correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
