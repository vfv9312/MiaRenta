<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';
    protected $guarded = ['id'];

    public function colonia()
    {
        return $this->belongsTo(Colonia::class, 'colonias_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
