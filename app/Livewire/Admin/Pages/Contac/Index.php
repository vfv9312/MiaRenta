<?php

namespace App\Livewire\Admin\Pages\Contac;

use App\Models\PageDetalleContacto;
use App\Models\PageCatalagoTipo;
use App\Models\Status;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;

    public $item_id, $status_id, $contacto_data_tipo_id, $recurso, $nueva_imagen;

    protected $rules = [
        'status_id' => 'required',
        'contacto_data_tipo_id' => 'required',
        'recurso' => 'required|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $detalles = PageDetalleContacto::with(['catalagoTipo.tipo', 'status'])
            ->where('recurso', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        $tipos = PageCatalagoTipo::with('tipo')->get();
        $statuses = Status::all();

        return view('livewire.admin.pages.contac.index', compact('detalles', 'tipos', 'statuses'));
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
        $this->status_id = '';
        $this->contacto_data_tipo_id = '';
        $this->recurso = '';
        $this->nueva_imagen = null;
    }

    public function store()
    {
        $this->validate();

        PageDetalleContacto::updateOrCreate(
            ['id' => $this->item_id],
            [
                'status_id' => $this->status_id,
                'contacto_data_tipo_id' => $this->contacto_data_tipo_id,
                'recurso' => $this->recurso,
            ]
        );
        
        if ($this->nueva_imagen) {
            $tipo = PageCatalagoTipo::find($this->contacto_data_tipo_id);
            if ($tipo) {
                // If it's an SVG file, we might want to store the content, 
                // but for simplicity and consistency with "imagen" field usage in other parts, 
                // we'll store the path.
                $path = $this->nueva_imagen->store('public/contactos');
                $tipo->update(['imagen' => str_replace('public/', 'storage/', $path)]);
            }
        }

        session()->flash('message', $this->item_id ? 'Detalle actualizado correctamente.' : 'Detalle creado correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $detalle = PageDetalleContacto::findOrFail($id);
        $this->item_id = $id;
        $this->status_id = $detalle->status_id;
        $this->contacto_data_tipo_id = $detalle->contacto_data_tipo_id;
        $this->recurso = $detalle->recurso;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        PageDetalleContacto::findOrFail($this->item_id)->delete();
        session()->flash('message', 'Detalle eliminado correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
