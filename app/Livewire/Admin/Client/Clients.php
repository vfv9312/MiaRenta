<?php

namespace App\Livewire\Admin\Client;

use App\Models\Cliente;
use App\Models\Person;
use App\Models\Direccion;
use App\Models\CatalagoCliente;
use App\Models\TelefonoCliente;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Clients extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $showDeleteModal = false;

    // Client fields
    public $item_id, $nombre, $apellido, $correo, $INE, $CURP, $RFC;

    // Dynamic phones
    public $telefonos = [];

    // Dynamic addresses
    public $direcciones = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $clients = Cliente::with(['persona', 'telefonos', 'catalogoDirecciones.direccion'])
            ->whereIn('status_id', [1, 2])
            ->where(function ($q) {
                $q->where('correo', 'like', '%' . $this->search . '%')
                  ->orWhereHas('persona', function ($q2) {
                      $q2->where('nombre', 'like', '%' . $this->search . '%')
                         ->orWhere('apellido', 'like', '%' . $this->search . '%');
                  });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.client.clients', compact('clients'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->addPhone();
        $this->addAddress();
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
        $this->apellido = '';
        $this->correo = '';
        $this->INE = '';
        $this->CURP = '';
        $this->RFC = '';
        $this->telefonos = [];
        $this->direcciones = [];
    }

    // ===== PHONE MANAGEMENT =====
    public function addPhone()
    {
        $this->telefonos[] = ['telefono' => '', 'tipo' => 'whatsapp', 'prioridad' => count($this->telefonos) + 1];
    }

    public function removePhone($index)
    {
        unset($this->telefonos[$index]);
        $this->telefonos = array_values($this->telefonos);
    }

    // ===== ADDRESS MANAGEMENT =====
    public function addAddress()
    {
        $this->direcciones[] = [
            'calle' => '',
            'entre_calles' => '',
            'referencia' => '',
            'cp' => '',
            'lat' => '',
            'lng' => '',
            'prioridad' => count($this->direcciones) + 1,
        ];
    }

    public function removeAddress($index)
    {
        unset($this->direcciones[$index]);
        $this->direcciones = array_values($this->direcciones);
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefonos' => 'required|array|min:1',
            'telefonos.*.telefono' => 'required|string|max:20',
            'telefonos.*.tipo' => 'required|in:whatsapp,telefono,ambos',
            'direcciones' => 'required|array|min:1',
            'direcciones.*.calle' => 'required|string|max:255',
            'direcciones.*.entre_calles' => 'required|string|max:255',
            'direcciones.*.referencia' => 'required|string',
        ]);

        DB::transaction(function () {
            // Create or update Person
            if ($this->item_id) {
                $cliente = Cliente::findOrFail($this->item_id);
                $persona = $cliente->persona;
                $persona->update([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'INE' => $this->INE,
                    'CURP' => $this->CURP,
                    'RFC' => $this->RFC,
                ]);
                $cliente->update(['correo' => $this->correo]);

                // Soft-delete old phones and addresses
                TelefonoCliente::where('cliente_id', $cliente->id)->update(['status_id' => 3]);
                CatalagoCliente::where('cliente_id', $cliente->id)->update(['status_id' => 3]);
            } else {
                $persona = Person::create([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'INE' => $this->INE,
                    'CURP' => $this->CURP,
                    'RFC' => $this->RFC,
                ]);

                $cliente = Cliente::create([
                    'persona_id' => $persona->id,
                    'correo' => $this->correo,
                    'status_id' => 1,
                ]);
            }

            // Save phones
            foreach ($this->telefonos as $i => $tel) {
                TelefonoCliente::create([
                    'cliente_id' => $cliente->id,
                    'telefono' => $tel['telefono'],
                    'tipo' => $tel['tipo'],
                    'prioridad' => $i + 1,
                    'status_id' => 1,
                ]);
            }

            // Save addresses
            foreach ($this->direcciones as $i => $dir) {
                $coordenadas = null;
                if (!empty($dir['lat']) && !empty($dir['lng'])) {
                    $coordenadas = DB::raw("ST_GeomFromText('POINT({$dir['lng']} {$dir['lat']})')");
                }

                $direccion = Direccion::create([
                    'colonias_id' => 1, // Default, can be improved
                    'calle' => $dir['calle'],
                    'entre_calles' => $dir['entre_calles'],
                    'referencia' => $dir['referencia'],
                    'cp' => !empty($dir['cp']) ? $dir['cp'] : null,
                    'cordenadas' => $coordenadas,
                    'status_id' => 1,
                ]);

                CatalagoCliente::create([
                    'cliente_id' => $cliente->id,
                    'direccion_id' => $direccion->id,
                    'prioridad' => $i + 1,
                    'status_id' => 1,
                ]);
            }
        });

        session()->flash('message', $this->item_id ? 'Cliente actualizado correctamente.' : 'Cliente creado correctamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $cliente = Cliente::with(['persona', 'telefonos', 'catalogoDirecciones.direccion'])->findOrFail($id);
        $this->item_id = $id;
        $this->nombre = $cliente->persona->nombre;
        $this->apellido = $cliente->persona->apellido;
        $this->correo = $cliente->correo;
        $this->INE = $cliente->persona->INE;
        $this->CURP = $cliente->persona->CURP;
        $this->RFC = $cliente->persona->RFC;

        $this->telefonos = $cliente->telefonos->map(function ($t) {
            return ['telefono' => $t->telefono, 'tipo' => $t->tipo, 'prioridad' => $t->prioridad];
        })->toArray();

        $this->direcciones = $cliente->catalogoDirecciones->map(function ($cd) {
            $dir = $cd->direccion;
            $lat = '';
            $lng = '';
            if ($dir && $dir->cordenadas) {
                // Extract coordinates from database POINT
                $point = DB::selectOne("SELECT ST_X(cordenadas) as lng, ST_Y(cordenadas) as lat FROM direcciones WHERE id = ?", [$dir->id]);
                if ($point) {
                    $lat = $point->lat;
                    $lng = $point->lng;
                }
            }
            return [
                'calle' => $dir->calle ?? '',
                'entre_calles' => $dir->entre_calles ?? '',
                'referencia' => $dir->referencia ?? '',
                'cp' => $dir->cp ?? '',
                'lat' => $lat,
                'lng' => $lng,
                'prioridad' => $cd->prioridad,
            ];
        })->toArray();

        if (empty($this->telefonos)) $this->addPhone();
        if (empty($this->direcciones)) $this->addAddress();

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->item_id = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $cliente = Cliente::findOrFail($this->item_id);
        $cliente->update(['status_id' => 3]);
        TelefonoCliente::where('cliente_id', $cliente->id)->update(['status_id' => 3]);
        CatalagoCliente::where('cliente_id', $cliente->id)->update(['status_id' => 3]);

        session()->flash('message', 'Cliente eliminado correctamente.');
        $this->showDeleteModal = false;
        $this->item_id = null;
    }
}
