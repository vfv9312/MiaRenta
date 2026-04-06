<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$f_inicio = '2026-04-05';
$f_fin = '2026-04-05';

$query = \Illuminate\Support\Facades\DB::table('alquileres_productos')
    ->join('alquileres', 'alquileres_productos.alquiler_id', '=', 'alquileres.id')
    ->whereIn('alquileres.status_id', [7, 9, 10, 11, 12])
    ->where(function($query) use ($f_inicio, $f_fin) {
        $query->whereDate('alquileres.fecha_entrega', '<=', $f_fin)
              ->whereDate('alquileres.fecha_recepcion', '>=', $f_inicio);
    })
    ->toSql();
echo $query . "\n";
print_r(\Illuminate\Support\Facades\DB::table('alquileres')->get()->toArray());
