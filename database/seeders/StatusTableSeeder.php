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
    }
}
