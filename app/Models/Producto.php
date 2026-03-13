<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $guarded = ['id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function catalogoTipo()
    {
        return $this->belongsTo(CatalagoTipo::class, 'catalogo_tipo_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function precios()
    {
        return $this->hasMany(CatalagoPrecio::class, 'producto_id');
    }

    public function precioActivo()
    {
        return $this->hasOne(CatalagoPrecio::class, 'producto_id')->where('status_id', 1)->latest();
    }

    public function imagenes()
    {
        return $this->hasMany(CatalogoImagen::class, 'producto_id')->whereIn('status_id', [1, 2]);
    }

    public function combinaciones()
    {
        return $this->belongsToMany(Combinacion::class, 'combinacion_producto');
    }
}
