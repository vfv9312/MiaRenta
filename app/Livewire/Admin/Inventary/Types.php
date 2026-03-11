<?php

namespace App\Livewire\Admin\Inventary;

use App\Models\Tipo;
use Livewire\Component;
use Livewire\WithPagination;

class Types extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;

    public $item_id, $nombre;

    protected $rules = [
        'nombre' => 'required|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $types = Tipo::where('nombre', 'like', '%' . $this->search . '%')
            ->whereIn('status_id', [1, 2])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.inventary.types', compact('types'));
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
    }

    public function store()
    {
        $this->validate();

        Tipo::updateOrCreate(
            ['id' => $this->item_id],
            ['nombre' => $this->nombre]
        );

        session()->flash('message', $this->item_id ? 'Tipo actualizado correctamente.' : 'Tipo creado correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $type = Tipo::findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $type->nombre;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $type = Tipo::findOrFail($this->item_id);
        $type->update(['status_id' => 3]);
        session()->flash('message', 'Tipo eliminado correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
