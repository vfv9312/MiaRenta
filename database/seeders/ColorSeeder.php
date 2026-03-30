<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mb_internal_encoding('UTF-8');
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Cafe', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Blanco', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Negro', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Gris', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Azul', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Rojo', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Verde', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Amarillo', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Naranja', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Morado', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Rosa', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Marron', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Beige', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Turquesa', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Dorado', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Plateado', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Bronce', MB_CASE_TITLE),
        ]);
        Color::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Cobre', MB_CASE_TITLE),
        ]);
    }
}
