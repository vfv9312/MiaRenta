<?php

namespace App\Livewire\Admin\Inventary;

use App\Models\Categorias as CategoriaModel;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
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
        // Load relationships and respect search query. The badge will visually indicate the status (e.g., active vs deleted).
        $categorias = CategoriaModel::with('status')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->whereIn('status_id', [1, 2])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.inventary.categorias', compact('categorias'));
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

        CategoriaModel::updateOrCreate(
            ['id' => $this->item_id],
            [
                'nombre' => $this->nombre,
                // On create, 'status_id' will default to 1 (Activo) per the database migration.
            ]
        );

        session()->flash('message', $this->item_id ? 'Categoría actualizada correctamente.' : 'Categoría creada correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $categoria = CategoriaModel::findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $categoria->nombre;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        // Implement Soft Delete: Update status_id to 3 instead of dropping the record
        $categoria = CategoriaModel::findOrFail($this->item_id);
        $categoria->update(['status_id' => 3]);

        session()->flash('message', 'Categoría eliminada (desactivada) correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
