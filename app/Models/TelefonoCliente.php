<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoCliente extends Model
{
    use HasFactory;

    protected $table = 'telefonos_clientes';
    protected $guarded = ['id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
