<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $guarded = [];

    public function catalago()
    {
        return $this->hasMany(PageCatalagoTipo::class);
    }

    public function tipo()
    {
        return $this->hasMany(TipoContacto::class);
    }
}
