<?php

namespace App\Livewire\Admin\Inventary;

use App\Models\Reparacion;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class Repairs extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;
    public $showRepairModal = false;

    // Create fields
    public $item_id, $producto_id, $cantidad, $fecha, $descripcion;

    // Repair completion fields
    public $cantidad_reparada, $precio, $fecha_reparacion;

    protected $rules = [
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'fecha' => 'required|date',
        'descripcion' => 'required|string|max:500',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $repairs = Reparacion::with('producto')
            ->whereIn('status_id', [4, 5])
            ->where(function ($q) {
                $q->where('descripcion', 'like', '%' . $this->search . '%')
                  ->orWhereHas('producto', function ($q2) {
                      $q2->where('nombre', 'like', '%' . $this->search . '%');
                  });
            })
            ->latest()
            ->paginate(10);

        $productos = Producto::whereIn('status_id', [1, 2])->orderBy('nombre')->get();

        return view('livewire.admin.inventary.repairs', compact('repairs', 'productos'));
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
        $this->producto_id = '';
        $this->cantidad = '';
        $this->fecha = date('Y-m-d');
        $this->descripcion = '';
        $this->cantidad_reparada = '';
        $this->precio = '';
        $this->fecha_reparacion = '';
    }

    public function store()
    {
        $this->validate();

        Reparacion::create([
            'producto_id' => $this->producto_id,
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
            'status_id' => 5, // En Reparación
        ]);

        session()->flash('message', 'Reparación registrada correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function openRepairModal($id)
    {
        $repair = Reparacion::findOrFail($id);
        $this->item_id = $id;
        $this->cantidad_reparada = $repair->cantidad; // default: all repaired
        $this->precio = '';
        $this->fecha_reparacion = date('Y-m-d');
        $this->showRepairModal = true;
    }

    public function closeRepairModal()
    {
        $this->showRepairModal = false;
        $this->resetValidation();
    }

    public function markRepaired()
    {
        $repair = Reparacion::findOrFail($this->item_id);

        $this->validate([
            'cantidad_reparada' => 'required|integer|min:0|max:' . $repair->cantidad,
            'precio' => 'required|numeric|min:0',
            'fecha_reparacion' => 'required|date',
        ]);

        $repair->update([
            'cantidad_reparada' => $this->cantidad_reparada,
            'precio' => $this->precio,
            'fecha_reparacion' => $this->fecha_reparacion,
            'status_id' => 4, // Reparado
        ]);

        session()->flash('message', 'Reparación completada. Se repararon ' . $this->cantidad_reparada . ' de ' . $repair->cantidad . ' unidades.');
        $this->showRepairModal = false;
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $repair = Reparacion::findOrFail($id);
        $this->item_id = $id;
        $this->producto_id = $repair->producto_id;
        $this->cantidad = $repair->cantidad;
        $this->fecha = $repair->fecha->format('Y-m-d');
        $this->descripcion = $repair->descripcion;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();

        $repair = Reparacion::findOrFail($this->item_id);
        $repair->update([
            'producto_id' => $this->producto_id,
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Reparación actualizada correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $repair = Reparacion::findOrFail($this->item_id);
        $repair->update(['status_id' => 3]); // Eliminado
        session()->flash('message', 'Reparación eliminada correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
