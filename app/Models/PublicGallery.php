<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicGallery extends Model
{
    use HasFactory;
    protected $table = 'public_galleries';
    protected $guarded = [];

    public function setNamesAttribute($value) {}
}
