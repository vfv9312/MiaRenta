<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mb_internal_encoding('UTF-8');
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Tela', MB_CASE_TITLE),
        ]);
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Plastico', MB_CASE_TITLE),
        ]);
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Madera', MB_CASE_TITLE),
        ]);
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Metal', MB_CASE_TITLE),
        ]);
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Vidrio', MB_CASE_TITLE),
        ]);
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Porcelana', MB_CASE_TITLE),
        ]);
        Tipo::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Otros', MB_CASE_TITLE),
        ]);
    }
}
