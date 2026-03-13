<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $guarded = ['id'];

    public function persona()
    {
        return $this->belongsTo(Person::class, 'persona_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function telefonos()
    {
        return $this->hasMany(TelefonoCliente::class, 'cliente_id')->whereIn('status_id', [1, 2]);
    }

    public function catalogoDirecciones()
    {
        return $this->hasMany(CatalagoCliente::class, 'cliente_id')->whereIn('status_id', [1, 2]);
    }

    public function direcciones()
    {
        return $this->belongsToMany(Direccion::class, 'catalago_clientes', 'cliente_id', 'direccion_id')
            ->withPivot('prioridad', 'status_id')
            ->wherePivotIn('status_id', [1, 2]);
    }
}
