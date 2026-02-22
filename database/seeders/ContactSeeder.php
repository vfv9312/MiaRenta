<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\PageCatalagoTipo;
use App\Models\TipoContacto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        mb_internal_encoding('UTF-8');

        TipoContacto::create([
            'nombre' => 'Facebook',
        ]);

        TipoContacto::create([
            'nombre' => 'Instagram',
        ]);

        TipoContacto::create([
            'nombre' => 'WhatsApp',
        ]);

        TipoContacto::create([
            'nombre' => 'TikTok',
        ]);

        TipoContacto::create([
            'nombre' => 'YouTube',
        ]);

        TipoContacto::create([
            'nombre' => 'Twitter',
        ]);

        TipoContacto::create([
            'nombre' => 'LinkedIn',
        ]);

        TipoContacto::create([
            'nombre' => 'Otro',
        ]);
        Categorias::create([
            'nombre' => 'Redes Sociales',
        ]);
        Categorias::create([
            'nombre' => 'Pagina Web',
        ]);
        Categorias::create([
            'nombre' => 'Correo Electronico',
        ]);
        Categorias::create([
            'nombre' => 'Telefono',
        ]);
        Categorias::create([
            'nombre' => 'Otro',
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 1,
            'categoria_id' => 1,
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 2,
            'categoria_id' => 1,
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 3,
            'categoria_id' => 1,
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 4,
            'categoria_id' => 1,
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 5,
            'categoria_id' => 1,
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 6,
            'categoria_id' => 1,
        ]);
        PageCatalagoTipo::create([
            'tipo_id' => 7,
            'categoria_id' => 1,
        ]);
    }
}
