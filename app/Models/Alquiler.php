<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $table = 'alquileres';
    protected $guarded = ['id'];

    protected $casts = [
        'fecha_solicitada' => 'datetime',
        'fecha_entrega' => 'datetime',
        'fecha_recepcion' => 'datetime',
        'fecha_finalizada' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function direccionCliente()
    {
        return $this->belongsTo(CatalagoCliente::class, 'direcciónes_clientes_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }

    public function productos()
    {
        return $this->hasMany(AlquileresProducto::class, 'alquiler_id');
    }
}
