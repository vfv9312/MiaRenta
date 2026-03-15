<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;

    protected $table = 'metodos_pagos';
    protected $guarded = ['id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
