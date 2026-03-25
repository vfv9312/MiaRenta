<?php

namespace App\Livewire\Admin\Client;

use App\Models\Cliente;
use App\Models\Person;
use App\Models\Direccion;
use App\Models\CatalagoCliente;
use App\Models\Colonia;
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

    // Colonia search results per address index
    public $coloniaResults = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $clients = Cliente::with(['persona', 'telefonos', 'catalogoDirecciones.direccion.colonia'])
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
        return redirect()->route('clientes.crear');
    }

    public function openModal()
    {
        $this->isOpen = true;
        // IMPORTANTE: Avisar a JS que el modal ya existe en el DOM
        $this->dispatch('modal-opened');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
        $this->coloniaResults = [];
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
        $this->coloniaResults = [];
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
            'colonias_id' => '',
            'colonia_nombre' => '',
            'calle' => '',
            'entre_calles' => '',
            'referencia' => '',
            'cp' => '',
            'lat' => '',
            'lng' => '',
            'prioridad' => count($this->direcciones) + 1,
        ];
        // Re-inicializar mapas para que el nuevo mapa se dibuje
        $this->dispatch('modal-opened');
    }

    public function removeAddress($index)
    {
        unset($this->direcciones[$index]);
        $this->direcciones = array_values($this->direcciones);
        unset($this->coloniaResults[$index]);
        $this->coloniaResults = array_values($this->coloniaResults);
    }

    public function search_colonia($index)
    {
        $searchTerm = $this->direcciones[$index]['colonia_nombre'];

        if (strlen($searchTerm) < 3) {
            $this->coloniaResults[$index] = [];
            return;
        }

        $this->coloniaResults[$index] = Colonia::whereIn('estatus', [1, 2])
            ->where(function ($q) use ($searchTerm) {
                $q->where('localidad', 'like', '%' . $searchTerm . '%')
                    ->orWhere('municipio', 'like', '%' . $searchTerm . '%')
                    ->orWhere('cp', 'like', '%' . $searchTerm . '%');
            })
            ->limit(5)
            ->get(['id', 'localidad', 'municipio', 'cp', 'estado'])
            ->toArray();
    }

    public function select_colonia($index, $coloniaId, $localidad, $municipio, $cp)
    {
        $this->direcciones[$index]['colonias_id'] = $coloniaId;
        $this->direcciones[$index]['colonia_nombre'] = "{$localidad}, {$municipio} (CP: {$cp})";
        $this->direcciones[$index]['cp'] = $cp;
        $this->coloniaResults[$index] = [];
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
                    // IMPORTANTE: Primero Longitud ($lng), luego Latitud ($lat)
                    $coordenadas = DB::raw("ST_GeomFromText('POINT({$dir['lng']} {$dir['lat']})')");
                }

                $direccion = Direccion::create([
                    'colonias_id' => $dir['colonias_id'] ?: 1, // Use selected or default
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
        return redirect()->route('clientes.editar', $id);
    }

    public function updatedDirecciones($value, $key)
    {
        // Buscamos si el cambio fue en el campo 'referencia' o 'calle'
        if (str_contains($key, '.referencia') || str_contains($key, '.calle')) {

            // Expresión regular para detectar coordenadas en enlaces de Google Maps
            // Ejemplo: https://www.google.com/maps?q=16.7527,-93.1167
            if (preg_match('/@?(-?\d+\.\d+),(-?\d+\.\d+)/', $value, $matches)) {
                $index = explode('.', $key)[0]; // Obtenemos el índice de la dirección (0, 1, 2...)

                $this->direcciones[$index]['lat'] = $matches[1];
                $this->direcciones[$index]['lng'] = $matches[2];

                // Avisar al JS para que mueva el PIN del mapa a esta nueva posición
                $this->dispatch('posicion-actualizada', [
                    'index' => $index,
                    'lat' => $matches[1],
                    'lng' => $matches[2]
                ]);
            }
        }
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
