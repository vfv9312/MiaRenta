<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaSolicitada extends Model
{
    use HasFactory;

    protected $table = 'facturas_solicitadas';

    protected $fillable = [
        'numero_ticket',
        'rfc',
        'razon_social',
        'regimen',
        'uso_cfdi',
        'cp',
        'email',
        'constancia_path',
        'nota_path',
    ];
}
