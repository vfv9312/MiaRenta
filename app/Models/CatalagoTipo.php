<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalagoTipo extends Model
{
    use HasFactory;

    protected $table = 'catalago_tipos';
    protected $guarded = ['id'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
