<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesCarrusel extends Model
{
    use HasFactory;
    protected $table = 'imagenes_carrusel';
    protected $guarded = ['id'];

    public function setNamesAttribute($value)
    {

    }
}
