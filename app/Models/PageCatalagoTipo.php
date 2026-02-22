<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCatalagoTipo extends Model
{
    use HasFactory;
    protected $table = 'page_catalago_tipo';
    protected $guarded = [];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id', 'id');
    }
    public function tipo()
    {
        return $this->belongsTo(TipoContacto::class, 'tipo_id', 'id');
    }
}
