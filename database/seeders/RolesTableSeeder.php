<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        mb_internal_encoding('UTF-8');
        Role::create(['name' => mb_convert_case('Administrador', MB_CASE_TITLE)]); //1
        Role::create(['name' => mb_convert_case('Cliente', MB_CASE_TITLE)]); //2
        Role::create(['name' => mb_convert_case('Empleado', MB_CASE_TITLE)]); //3
    }
}
