<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $guarded = ['id'];

    public function page_catalags()
    {
        return $this->hasMany(PageCatalag::class);
    }

    public function carousels()
    {
        return $this->hasMany(carousel::class);
    }
}
