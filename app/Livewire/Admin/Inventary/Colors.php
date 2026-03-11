<?php

namespace App\Livewire\Admin\Inventary;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Colors extends Component
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
        $colors = Color::where('nombre', 'like', '%' . $this->search . '%')
            ->whereIn('status_id', [1, 2])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.inventary.colors', compact('colors'));
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

        Color::updateOrCreate(
            ['id' => $this->item_id],
            ['nombre' => $this->nombre]
        );

        session()->flash('message', $this->item_id ? 'Color actualizado correctamente.' : 'Color creado correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $color->nombre;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $color = Color::findOrFail($this->item_id);
        $color->update(['status_id' => 3]);
        session()->flash('message', 'Color eliminado correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
