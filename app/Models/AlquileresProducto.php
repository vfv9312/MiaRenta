<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlquileresProducto extends Model
{
    use HasFactory;

    protected $table = 'alquileres_productos';
    protected $guarded = ['id'];

    public function alquiler()
    {
        return $this->belongsTo(Alquiler::class, 'alquiler_id');
    }

    public function catalogoPrecio()
    {
        return $this->belongsTo(CatalagoPrecio::class, 'Catalogo_precio_id');
    }
}
