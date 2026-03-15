<?php

namespace App\Livewire\Admin\Configuration;

use App\Models\Colonia;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Colonias extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;
    public $item_id;

    // Fields
    public $cp, $id_estado, $estado, $id_municipio, $municipio, $id_localidad, $localidad;
    public $lat, $lng;

    protected $rules = [
        'cp' => 'required|integer',
        'id_estado' => 'required|integer',
        'estado' => 'required|string|max:255',
        'id_municipio' => 'required|integer',
        'municipio' => 'required|string|max:255',
        'id_localidad' => 'required|integer',
        'localidad' => 'required|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $colonias = Colonia::where(function ($query) {
            $query->where('estado', 'like', '%' . $this->search . '%')
                ->orWhere('municipio', 'like', '%' . $this->search . '%')
                ->orWhere('localidad', 'like', '%' . $this->search . '%')
                ->orWhere('cp', 'like', '%' . $this->search . '%');
        })
            ->whereIn('estatus', [1, 2])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.configuration.colonias', compact('colonias'));
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
        $this->cp = '';
        $this->id_estado = '';
        $this->estado = '';
        $this->id_municipio = '';
        $this->municipio = '';
        $this->id_localidad = '';
        $this->localidad = '';
        $this->lat = '';
        $this->lng = '';
    }

    public function store()
    {
        $this->validate();

        $coordenadas = null;
        if (!empty($this->lat) && !empty($this->lng)) {
            $coordenadas = DB::raw("ST_GeomFromText('POINT({$this->lng} {$this->lat})')");
        }

        Colonia::updateOrCreate(['id' => $this->item_id], [
            'cp' => $this->cp,
            'id_estado' => $this->id_estado,
            'estado' => $this->estado,
            'id_municipio' => $this->id_municipio,
            'municipio' => $this->municipio,
            'id_localidad' => $this->id_localidad,
            'localidad' => $this->localidad,
            'cordenadas' => $coordenadas,
            'estatus' => 1,
        ]);

        session()->flash('message', $this->item_id ? 'Colonia actualizada correctamente.' : 'Colonia creada correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $colonia = Colonia::findOrFail($id);
        $this->item_id = $id;
        $this->cp = $colonia->cp;
        $this->id_estado = $colonia->id_estado;
        $this->estado = $colonia->estado;
        $this->id_municipio = $colonia->id_municipio;
        $this->municipio = $colonia->municipio;
        $this->id_localidad = $colonia->id_localidad;
        $this->localidad = $colonia->localidad;

        if ($colonia->cordenadas) {
            $point = DB::selectOne("SELECT ST_X(cordenadas) as lng, ST_Y(cordenadas) as lat FROM colonias WHERE id = ?", [$colonia->id]);
            if ($point) {
                $this->lat = $point->lat;
                $this->lng = $point->lng;
            }
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
        Colonia::find($this->item_id)->update([
            'estatus' => 3,
            'deleted_at' => now(),
        ]);
        session()->flash('message', 'Colonia eliminada correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
