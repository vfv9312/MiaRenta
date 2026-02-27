<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDetalleContacto extends Model
{
    use HasFactory;
    protected $table = '_detalles_contacto';
    protected $guarded = [];

    public function catalagoTipo()
    {
        return $this->belongsTo(PageCatalagoTipo::class, 'contacto_data_tipo_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
