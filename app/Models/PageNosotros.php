<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageNosotros extends Model
{
    use HasFactory;

    protected $table = 'page_nosotros';
    protected $guarded = [];

    protected $casts = [
        'values_list' => 'array',
    ];
}
