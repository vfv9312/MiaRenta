<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalagoCliente extends Model
{
    use HasFactory;

    protected $table = 'catalago_clientes';
    protected $guarded = ['id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
