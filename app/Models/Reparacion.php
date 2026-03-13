<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    use HasFactory;

    protected $table = 'reparaciones';
    protected $guarded = ['id'];

    protected $casts = [
        'fecha' => 'date',
        'fecha_reparacion' => 'date',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
