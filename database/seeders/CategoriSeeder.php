<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        mb_internal_encoding('UTF-8');
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Sillas', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Mesas', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Manteleria', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Servilletas', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Camino de mesa', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Cubre mantel', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Vajilla', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Vasos', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Copas', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Plato Pastelero', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Plato Hondo', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Plato Plano', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Loza', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Cubiertos', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Funda sillas', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Moños', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Decoracion', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Iluminacion', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Lona', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Carpas', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Inflables', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Pista de Baile', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Barra', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Hielera', MB_CASE_TITLE),
        ]);
        Categorias::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Otros', MB_CASE_TITLE),
        ]);
    }
}
