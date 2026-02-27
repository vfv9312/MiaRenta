<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCatalagoTipo extends Model
{
    use HasFactory;
    protected $table = 'contactos_data_tipos';
    protected $guarded = [];

    public function tipo()
    {
        return $this->belongsTo(TipoContacto::class, 'contacto_tipo_id', 'id');
    }
}
