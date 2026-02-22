<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDetalleContacto extends Model
{
    use HasFactory;
    protected $table = '_detalles_contacto';
    protected $guarded = [];

    public function catalago()
    {
        return $this->belongsTo(PageCatalagoTipo::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoContacto::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class);
    }
}
