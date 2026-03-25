<?php

namespace App\Livewire\Admin\Client;

use App\Models\Cliente;
use App\Models\Person;
use App\Models\Direccion;
use App\Models\CatalagoCliente;
use App\Models\TelefonoCliente;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ClientForm extends Component
{
    public $clientId = null;

    // Client fields
    public $nombre, $apellido, $correo, $INE, $CURP, $RFC;

    // Dynamic phones
    public $telefonos = [];

    // Dynamic addresses
    public $direcciones = [];

    // Colonia search results per address index
    public $coloniaResults = [];

    public function mount($clientId = null)
    {
        $this->clientId = $clientId;

        if ($clientId) {
            $this->loadClient($clientId);
        } else {
            $this->addPhone();
            $this->addAddress();
        }
    }

    private function loadClient($id)
    {
        $cliente = Cliente::with(['persona', 'telefonos', 'catalogoDirecciones.direccion.colonia'])->findOrFail($id);

        $this->nombre    = $cliente->persona->nombre;
        $this->apellido  = $cliente->persona->apellido;
        $this->correo    = $cliente->correo;
        $this->INE       = $cliente->persona->INE;
        $this->CURP      = $cliente->persona->CURP;
        $this->RFC       = $cliente->persona->RFC;

        $this->telefonos = $cliente->telefonos->map(function ($t) {
            return ['telefono' => $t->telefono, 'tipo' => $t->tipo, 'prioridad' => $t->prioridad];
        })->toArray();

        $this->direcciones = $cliente->catalogoDirecciones->map(function ($cd) {
            $dir = $cd->direccion;
            $lat = '';
            $lng = '';
            if ($dir && $dir->cordenadas) {
                $point = DB::selectOne("SELECT ST_X(cordenadas) as lng, ST_Y(cordenadas) as lat FROM direcciones WHERE id = ?", [$dir->id]);
                if ($point) {
                    $lat = $point->lat;
                    $lng = $point->lng;
                }
            }
            $colonia_nombre = '';
            if ($dir && $dir->colonia) {
                $colonia_nombre = "{$dir->colonia->localidad}, {$dir->colonia->municipio} (CP: {$dir->colonia->cp})";
            }
            return [
                'colonias_id'   => $dir->colonias_id ?? '',
                'colonia_nombre'=> $colonia_nombre,
                'calle'         => $dir->calle ?? '',
                'entre_calles'  => $dir->entre_calles ?? '',
                'referencia'    => $dir->referencia ?? '',
                'cp'            => $dir->cp ?? '',
                'lat'           => $lat,
                'lng'           => $lng,
                'google_maps_url' => '',
                'prioridad'     => $cd->prioridad,
            ];
        })->toArray();

        if (empty($this->telefonos))  $this->addPhone();
        if (empty($this->direcciones)) $this->addAddress();
    }

    public function render()
    {
        return view('livewire.admin.client.client-form');
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
            'colonias_id'   => '',
            'colonia_nombre'=> '',
            'calle'         => '',
            'entre_calles'  => '',
            'referencia'    => '',
            'cp'            => '',
            'lat'           => '',
            'lng'           => '',
            'google_maps_url' => '',
            'prioridad'     => count($this->direcciones) + 1,
        ];
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
        $this->coloniaResults[$index] = \App\Models\Colonia::whereIn('estatus', [1, 2])
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
        $this->direcciones[$index]['colonias_id']    = $coloniaId;
        $this->direcciones[$index]['colonia_nombre'] = "{$localidad}, {$municipio} (CP: {$cp})";
        $this->direcciones[$index]['cp']             = $cp;
        $this->coloniaResults[$index]                = [];
    }

    public function updatedDirecciones($value, $key)
    {
        // Check if the updated key is 'google_maps_url'
        if (str_ends_with($key, '.google_maps_url')) {
            $index = explode('.', $key)[0];
            $url = trim($value);

            if (empty($url)) return;

            // If it's a short URL (maps.app.goo.gl or goo.gl/maps)
            if (str_contains($url, 'maps.app.goo.gl') || str_contains($url, 'goo.gl/maps')) {
                try {
                    $response = Http::timeout(5)->get($url);
                    if ($response->successful()) {
                        $url = $response->effectiveUri()->__toString();
                    }
                } catch (\Exception $e) {
                    // Log error or notify user if needed
                }
            }

            // Regex for @lat,lng or place/lat,lng
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches) || 
                preg_match('/place\/(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
                $this->direcciones[$index]['lat'] = $matches[1];
                $this->direcciones[$index]['lng'] = $matches[2];
            }
        }
    }

    public function store()
    {
        $this->validate([
            'nombre'                   => 'required|string|max:255',
            'apellido'                 => 'required|string|max:255',
            'correo'                   => 'required|email|max:255',
            'telefonos'                => 'required|array|min:1',
            'telefonos.*.telefono'     => 'required|string|max:20',
            'telefonos.*.tipo'         => 'required|in:whatsapp,telefono,ambos',
            'direcciones'              => 'required|array|min:1',
            'direcciones.*.calle'      => 'required|string|max:255',
            'direcciones.*.entre_calles' => 'required|string|max:255',
            'direcciones.*.referencia' => 'required|string',
        ]);

        DB::transaction(function () {
            if ($this->clientId) {
                $cliente = Cliente::findOrFail($this->clientId);
                $persona = $cliente->persona;
                $persona->update([
                    'nombre'   => $this->nombre,
                    'apellido' => $this->apellido,
                    'INE'      => $this->INE,
                    'CURP'     => $this->CURP,
                    'RFC'      => $this->RFC,
                ]);
                $cliente->update(['correo' => $this->correo]);
                TelefonoCliente::where('cliente_id', $cliente->id)->update(['status_id' => 3]);
                CatalagoCliente::where('cliente_id', $cliente->id)->update(['status_id' => 3]);
            } else {
                $persona = Person::create([
                    'nombre'   => $this->nombre,
                    'apellido' => $this->apellido,
                    'INE'      => $this->INE,
                    'CURP'     => $this->CURP,
                    'RFC'      => $this->RFC,
                ]);
                $cliente = Cliente::create([
                    'persona_id' => $persona->id,
                    'correo'     => $this->correo,
                    'status_id'  => 1,
                ]);
            }

            foreach ($this->telefonos as $i => $tel) {
                TelefonoCliente::create([
                    'cliente_id' => $cliente->id,
                    'telefono'   => $tel['telefono'],
                    'tipo'       => $tel['tipo'],
                    'prioridad'  => $i + 1,
                    'status_id'  => 1,
                ]);
            }

            foreach ($this->direcciones as $i => $dir) {
                $coordenadas = null;
                if (!empty($dir['lat']) && !empty($dir['lng'])) {
                    // IMPORTANTE: Primero Longitud ($lng), luego Latitud ($lat)
                    $coordenadas = DB::raw("ST_GeomFromText('POINT({$dir['lng']} {$dir['lat']})')");
                }
                $direccion = Direccion::create([
                    'colonias_id'  => $dir['colonias_id'] ?: 1,
                    'calle'        => $dir['calle'],
                    'entre_calles' => $dir['entre_calles'],
                    'referencia'   => $dir['referencia'],
                    'cp'           => !empty($dir['cp']) ? $dir['cp'] : null,
                    'cordenadas'   => $coordenadas,
                    'status_id'    => 1,
                ]);
                CatalagoCliente::create([
                    'cliente_id'  => $cliente->id,
                    'direccion_id'=> $direccion->id,
                    'prioridad'   => $i + 1,
                    'status_id'   => 1,
                ]);
            }
        });

        session()->flash('message', $this->clientId ? 'Cliente actualizado correctamente.' : 'Cliente creado correctamente.');
        return redirect()->route('clientes');
    }
}
