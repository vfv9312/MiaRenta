<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$q = DB::table('alquileres_productos')
    ->join('alquileres', 'alquileres_productos.alquiler_id', '=', 'alquileres.id')
    ->join('catalago_precios', 'alquileres_productos.Catalogo_precio_id', '=', 'catalago_precios.id')
    ->join('productos', 'catalago_precios.producto_id', '=', 'productos.id')
    ->select(
        'productos.id as producto_id',
        'productos.nombre as nombre_producto', 
        DB::raw('sum(alquileres_productos.cantidad) as total_rentas'),
        DB::raw('sum(alquileres_productos.cantidad * catalago_precios.precio * GREATEST(1, COALESCE(DATEDIFF(alquileres.fecha_recepcion, alquileres.fecha_entrega), 1))) as total_dinero')
    )
    ->groupBy('productos.id', 'productos.nombre')
    ->take(5)
    ->get();
print_r($q);
