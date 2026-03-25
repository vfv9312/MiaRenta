<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\PageCatalagoTipo;
use App\Models\PageDetalleContacto;
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
            'nombre' => 'Redes Sociales',
        ]);

        TipoContacto::create([
            'nombre' => 'Correo Electronico',
        ]);

        TipoContacto::create([
            'nombre' => 'Telefono',
        ]);

        TipoContacto::create([
            'nombre' => 'Pagina Web',
        ]);


        TipoContacto::create([
            'nombre' => 'Otro',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'Facebook',
            'imagen' => 'storage/contactos/x7qn3mfNikhYaz7Jo3tmSWOrCWRvZiYxqdavmIfc.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'Instagram',
            'imagen' => 'storage/contactos/CqvnBspcc20HQq1E78eEUszml1PxaB8SywPKpQqC.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'Twitter',
            'imagen' => 'storage/contactos/ujsF3cDD08KHO2MQhE3FfsEOYmBfoQIxtgtRw0v6.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'TikTok',
            'imagen' => 'storage/contactos/GzdV2fBSuOEG6kc9yQdXkagh2np2nlWQD0UsTPHg.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'YouTube',
            'imagen' => 'storage/contactos/2hLIdybBCkhNIS8qHrZ5J5gVlBV7MyMrjmag1S64.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'LinkedIn',
            'imagen' => 'storage/contactos/iwiFwBHFCuf4uYV9wHdx8s3tqKrFdGyr6miYNdAV.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 2,
            'nombre' => 'Correo Electronico Reclamos',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 2,
            'nombre' => 'Correo Electronico Facturas',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 2,
            'nombre' => 'Correo Electronico General',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 1,
            'nombre' => 'WhatsApp',
            'imagen' => 'storage/contactos/ZUfJQ1V3VOrGLeIDzTkqpTzSUpJPma9tMIUbT7bp.png'
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 3,
            'nombre' => 'Telegram',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 3,
            'nombre' => 'SMS',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 3,
            'nombre' => 'Llamadas Oficina',
        ]);
        PageCatalagoTipo::create([
            'contacto_tipo_id' => 3,
            'nombre' => 'Llamadas Celular',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 1,
            'status_id' => 1,
            'recurso' => 'https://www.facebook.com/miarenta',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 2,
            'status_id' => 1,
            'recurso' => 'https://www.instagram.com/miarenta',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 3,
            'status_id' => 1,
            'recurso' => 'https://www.twitter.com/miarenta',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 4,
            'status_id' => 1,
            'recurso' => 'https://www.tiktok.com/miarenta',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 5,
            'status_id' => 1,
            'recurso' => 'https://www.youtube.com/miarenta',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 6,
            'status_id' => 1,
            'recurso' => 'https://www.linkedin.com/miarenta',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 7,
            'status_id' => 1,
            'recurso' => 'reclamo@miarenta.com',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 8,
            'status_id' => 1,
            'recurso' => 'facturacion@miarenta.com',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 9,
            'status_id' => 1,
            'recurso' => 'info@miarenta.com',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 10,
            'status_id' => 1,
            'recurso' => '15512345678',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 11,
            'status_id' => 1,
            'recurso' => '15512345678',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 12,
            'status_id' => 1,
            'recurso' => '15512345678',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 13,
            'status_id' => 1,
            'recurso' => '15512345678',
        ]);
        PageDetalleContacto::create([
            'contacto_data_tipo_id' => 14,
            'status_id' => 1,
            'recurso' => '15512345678',
        ]);
    }
}
