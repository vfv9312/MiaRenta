<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoImagen extends Model
{
    use HasFactory;

    protected $table = 'catalogo_imagines';
    protected $guarded = ['id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function combinacion()
    {
        return $this->belongsTo(Combinacion::class);
    }
}
