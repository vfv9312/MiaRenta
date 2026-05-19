<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Alquiler;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Estadisticas extends Component
{
    public $fecha_inicio;
    public $fecha_fin;
    public $productos_seleccionados = [];
    public $todos_productos = [];

    public function mount()
    {
        $this->todos_productos = \App\Models\Producto::where('status_id', 1)->pluck('nombre', 'id')->toArray();
    }

    public function filtrar()
    {
        $data = $this->loadData();
        $this->dispatch('update-charts', $data);
    }

    private function loadData()
    {
        // Query base para finalizados (Ingresos)
        $qFinalizados = Alquiler::where('status_id', 14)->whereNotNull('fecha_finalizada');
        if (!empty($this->fecha_inicio)) {
            $qFinalizados->whereDate('fecha_finalizada', '>=', $this->fecha_inicio);
        }
        if (!empty($this->fecha_fin)) {
            $qFinalizados->whereDate('fecha_finalizada', '<=', $this->fecha_fin);
        }
        $alquileres_finalizados = $qFinalizados->get();
        
        $dineroPorMesMap = [];
        foreach ($alquileres_finalizados as $alq) {
            $month = Carbon::parse($alq->fecha_finalizada)->format('Y-m');
            if (!isset($dineroPorMesMap[$month])) {
                $dineroPorMesMap[$month] = 0;
            }
            $dineroPorMesMap[$month] += $alq->total ?? 0;
        }
        ksort($dineroPorMesMap);

        // Clientes top (basados en created_at)
        $qClientes = Alquiler::with('cliente.persona')
            ->select('cliente_id', DB::raw('count(id) as total_rentas'))
            ->groupBy('cliente_id')
            ->orderByDesc('total_rentas')
            ->take(5);
        if (!empty($this->fecha_inicio)) $qClientes->whereDate('created_at', '>=', $this->fecha_inicio);
        if (!empty($this->fecha_fin)) $qClientes->whereDate('created_at', '<=', $this->fecha_fin);
        
        $clientesTop_db = $qClientes->get();
        $labelsClientes = [];
        $dataClientes = [];
        foreach ($clientesTop_db as $alq) {
            $labelsClientes[] = $alq->cliente->persona->nombre ?? 'Sin nombre';
            $dataClientes[] = $alq->total_rentas;
        }

        // Rentas por mes (basados en created_at)
        $qTodos = Alquiler::query();
        if (!empty($this->fecha_inicio)) $qTodos->whereDate('created_at', '>=', $this->fecha_inicio);
        if (!empty($this->fecha_fin)) $qTodos->whereDate('created_at', '<=', $this->fecha_fin);
        $todosAlquileres = $qTodos->get();

        $rentasPorMesMap = [];
        foreach ($todosAlquileres as $alq) {
            $month = Carbon::parse($alq->created_at)->format('Y-m');
            if (!isset($rentasPorMesMap[$month])) {
                $rentasPorMesMap[$month] = 0;
            }
            $rentasPorMesMap[$month]++;
        }
        ksort($rentasPorMesMap);

        // Colonias (basados en created_at)
        $qColonias = Alquiler::with('direccionCliente.direccion.colonia');
        if (!empty($this->fecha_inicio)) $qColonias->whereDate('created_at', '>=', $this->fecha_inicio);
        if (!empty($this->fecha_fin)) $qColonias->whereDate('created_at', '<=', $this->fecha_fin);
        
        $todasColonias = $qColonias->get();
        $coloniasMap = [];
        
        foreach ($todasColonias as $alq) {
            $coloniaNombre = $alq->direccionCliente->direccion->colonia->localidad ?? 'Desconocida';
            if (!isset($coloniasMap[$coloniaNombre])) {
                $coloniasMap[$coloniaNombre] = 0;
            }
            $coloniasMap[$coloniaNombre]++;
        }
        
        arsort($coloniasMap);
        $coloniasMap = array_slice($coloniasMap, 0, 5, true);
        
        $labelsColonias = array_keys($coloniasMap);
        $dataColonias = array_values($coloniasMap);

        // Productos Top / Seleccionados
        $alquileresProductos = DB::table('alquileres_productos')
            ->join('alquileres', 'alquileres_productos.alquiler_id', '=', 'alquileres.id')
            ->join('catalago_precios', 'alquileres_productos.Catalogo_precio_id', '=', 'catalago_precios.id')
            ->join('productos', 'catalago_precios.producto_id', '=', 'productos.id')
            ->select(
                'productos.id as producto_id',
                'productos.nombre as nombre_producto', 
                'alquileres_productos.cantidad',
                'catalago_precios.precio',
                'alquileres.fecha_entrega',
                'alquileres.fecha_recepcion'
            );
            
        if (!empty($this->fecha_inicio)) $alquileresProductos->whereDate('alquileres.created_at', '>=', $this->fecha_inicio);
        if (!empty($this->fecha_fin)) $alquileresProductos->whereDate('alquileres.created_at', '<=', $this->fecha_fin);
        
        $allRentals = $alquileresProductos->get();
        $productosStats = [];

        foreach ($allRentals as $rent) {
            $prodId = $rent->producto_id;
            if (!isset($productosStats[$prodId])) {
                $productosStats[$prodId] = [
                    'nombre' => $rent->nombre_producto,
                    'cantidad' => 0,
                    'dinero' => 0
                ];
            }
            
            $dias = 1;
            if ($rent->fecha_entrega && $rent->fecha_recepcion) {
                try {
                    $f_inicio = \Carbon\Carbon::parse($rent->fecha_entrega)->startOfDay();
                    $f_fin = \Carbon\Carbon::parse($rent->fecha_recepcion)->startOfDay();
                    if (!$f_fin->lt($f_inicio)) {
                        $dias_diff = $f_inicio->diffInDays($f_fin);
                        $dias = $dias_diff == 0 ? 1 : $dias_diff;
                    }
                } catch (\Exception $e) {}
            }

            $productosStats[$prodId]['cantidad'] += $rent->cantidad;
            $productosStats[$prodId]['dinero'] += ($rent->cantidad * $rent->precio * $dias);
        }

        // Filter by selected products if any
        if (!empty($this->productos_seleccionados)) {
            $filteredStats = [];
            foreach ($this->productos_seleccionados as $pid) {
                if (isset($productosStats[$pid])) {
                    $filteredStats[$pid] = $productosStats[$pid];
                } else {
                    // Include it with 0 if selected but no data
                    $prodName = $this->todos_productos[$pid] ?? 'Desconocido';
                    $filteredStats[$pid] = [
                        'nombre' => $prodName,
                        'cantidad' => 0,
                        'dinero' => 0
                    ];
                }
            }
            $productosStats = array_values($filteredStats);
        } else {
            // Sort by cantidad descending and take top 5
            usort($productosStats, function($a, $b) {
                return $b['cantidad'] <=> $a['cantidad'];
            });
            $productosStats = array_slice($productosStats, 0, 5);
        }

        $labelsProductos = [];
        $dataProductos = [];
        $dataDineroProductos = [];
        foreach ($productosStats as $stat) {
            $labelsProductos[] = $stat['nombre'];
            $dataProductos[] = $stat['cantidad'];
            $dataDineroProductos[] = $stat['dinero'];
        }

        return [
            'labelsDinero' => array_keys($dineroPorMesMap), 'dataDinero' => array_values($dineroPorMesMap),
            'labelsClientes' => $labelsClientes, 'dataClientes' => $dataClientes,
            'labelsRentas' => array_keys($rentasPorMesMap), 'dataRentas' => array_values($rentasPorMesMap),
            'labelsColonias' => $labelsColonias, 'dataColonias' => $dataColonias,
            'labelsProductos' => $labelsProductos, 'dataProductos' => $dataProductos, 'dataDineroProductos' => $dataDineroProductos
        ];
    }

    public function render()
    {
        $chartData = $this->loadData();
        return view('livewire.admin.order.estadisticas', compact('chartData'));
    }
}
