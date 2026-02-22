<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContacto extends Model
{
    use HasFactory;

    protected $table = 'tipos_contacto';
    protected $guarded = [];

    public function catalago()
    {
        return $this->hasMany(PageCatalagoTipo::class);
    }
}
