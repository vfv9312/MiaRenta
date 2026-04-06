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
        $qColonias = DB::table('alquileres')
            ->join('catalago_clientes', 'alquileres.direcciónes_clientes_id', '=', 'catalago_clientes.id')
            ->join('direcciones', 'catalago_clientes.direccion_id', '=', 'direcciones.id')
            ->join('colonias', 'direcciones.colonias_id', '=', 'colonias.id')
            ->select('colonias.localidad as nombre_colonia', DB::raw('count(alquileres.id) as total_rentas'))
            ->groupBy('colonias.localidad')
            ->orderByDesc('total_rentas')
            ->take(5);
        if (!empty($this->fecha_inicio)) $qColonias->whereDate('alquileres.created_at', '>=', $this->fecha_inicio);
        if (!empty($this->fecha_fin)) $qColonias->whereDate('alquileres.created_at', '<=', $this->fecha_fin);
        
        $coloniasTop_db = $qColonias->get();
        $labelsColonias = [];
        $dataColonias = [];
        foreach ($coloniasTop_db as $col) {
            $labelsColonias[] = $col->nombre_colonia;
            $dataColonias[] = $col->total_rentas;
        }

        return [
            'labelsDinero' => array_keys($dineroPorMesMap), 'dataDinero' => array_values($dineroPorMesMap),
            'labelsClientes' => $labelsClientes, 'dataClientes' => $dataClientes,
            'labelsRentas' => array_keys($rentasPorMesMap), 'dataRentas' => array_values($rentasPorMesMap),
            'labelsColonias' => $labelsColonias, 'dataColonias' => $dataColonias
        ];
    }

    public function render()
    {
        $chartData = $this->loadData();
        return view('livewire.admin.order.estadisticas', compact('chartData'));
    }
}
