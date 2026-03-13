<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combinacion extends Model
{
    use HasFactory;

    protected $table = 'combinaciones';
    protected $guarded = ['id'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'combinacion_producto');
    }

    public function imagenes()
    {
        return $this->hasMany(CatalogoImagen::class, 'combinacion_id')->whereIn('status_id', [1, 2]);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
