<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        mb_internal_encoding('UTF-8');
        Status::create(['order' => 1, 'status_type_id' => 1, 'name' => mb_convert_case('Activo', MB_CASE_TITLE)]);
        Status::create(['order' => 2, 'status_type_id' => 1, 'name' => mb_convert_case('Inactivo', MB_CASE_TITLE)]);
        Status::create(['order' => 3, 'status_type_id' => 1, 'name' => mb_convert_case('Eliminado', MB_CASE_TITLE)]);
        Status::create(['order' => 4, 'status_type_id' => 2, 'name' => mb_convert_case('Reparado', MB_CASE_TITLE)]);
        Status::create(['order' => 5, 'status_type_id' => 2, 'name' => mb_convert_case('En Reparación', MB_CASE_TITLE)]);
        Status::create(['order' => 6, 'status_type_id' => 3, 'name' => mb_convert_case('Cotizacion', MB_CASE_TITLE)]);
        Status::create(['order' => 7, 'status_type_id' => 3, 'name' => mb_convert_case('Pendiente de pago', MB_CASE_TITLE)]);
        Status::create(['order' => 8, 'status_type_id' => 3, 'name' => mb_convert_case('Cancelado', MB_CASE_TITLE)]);
        Status::create(['order' => 9, 'status_type_id' => 3, 'name' => mb_convert_case('Anticipo', MB_CASE_TITLE)]);
        Status::create(['order' => 10, 'status_type_id' => 3, 'name' => mb_convert_case('Pagado', MB_CASE_TITLE)]);
        Status::create(['order' => 11, 'status_type_id' => 3, 'name' => mb_convert_case('Rentado', MB_CASE_TITLE)]);
        Status::create(['order' => 12, 'status_type_id' => 3, 'name' => mb_convert_case('Entregado', MB_CASE_TITLE)]);
        Status::create(['order' => 13, 'status_type_id' => 3, 'name' => mb_convert_case('Devuelto', MB_CASE_TITLE)]);
        Status::create(['order' => 14, 'status_type_id' => 3, 'name' => mb_convert_case('Finalizado', MB_CASE_TITLE)]);
    }
}
