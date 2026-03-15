<?php

namespace App\Livewire\Admin\Configuration;

use App\Models\MetodoPago;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class Metodospago extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;
    public $item_id;

    // Fields
    public $nombre, $status_id = 1;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'status_id' => 'required|exists:status,id',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $metodos = MetodoPago::with('status')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->whereIn('status_id', [1, 2])
            ->latest()
            ->paginate(10);

        $statuses = Status::whereIn('id', [1, 2])->get();

        return view('livewire.admin.configuration.metodospago', compact('metodos', 'statuses'));
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
        $this->status_id = 1;
    }

    public function store()
    {
        $this->validate();

        MetodoPago::updateOrCreate(['id' => $this->item_id], [
            'nombre' => $this->nombre,
            'status_id' => $this->status_id,
        ]);

        session()->flash('message', $this->item_id ? 'Método de pago actualizado con éxito.' : 'Método de pago creado con éxito.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $metodo->nombre;
        $this->status_id = $metodo->status_id;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $metodo = MetodoPago::findOrFail($this->item_id);
        $metodo->update(['status_id' => 3]); // Soft delete

        session()->flash('message', 'Método de pago eliminado con éxito.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
