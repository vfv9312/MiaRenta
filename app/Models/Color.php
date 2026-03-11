<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colores';

    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
