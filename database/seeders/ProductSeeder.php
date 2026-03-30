<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'categoria_id'          => 1,
            'tipo_id'               => 1,
            'color_id'              => 1,
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Vajilla', MB_CASE_TITLE),
            'descripcion'           => 'Vajilla de porcelana',
            'precio'                => 10,
            'precio_mayoreo'        => 5,
            'precio_renta'          => 1,
            'precio_renta_mayoreo'  => 0.5,
            'precio_renta_mayoreo'  => 0.5,
        ]);
    }
}
