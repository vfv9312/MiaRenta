<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MetodoPago;

class Pay extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mb_internal_encoding('UTF-8');
        MetodoPago::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Efectivo', MB_CASE_TITLE),
        ]);
        MetodoPago::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Transferencia', MB_CASE_TITLE),
        ]);
        MetodoPago::create([
            'status_id'             => 1,
            'nombre'                => mb_convert_case('Tarjeta', MB_CASE_TITLE),
        ]);
    }
}
