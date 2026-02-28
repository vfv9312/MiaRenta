<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCatalag extends Model
{
    use HasFactory;

    protected $table = 'page_catalags';
    protected $guarded = [];

    public function status_one()
    {
        return $this->belongsTo(Status::class);
    }

    public function status_two()
    {
        return $this->belongsTo(Status::class);
    }

    public function status_three()
    {
        return $this->belongsTo(Status::class);
    }

    public function status_four()
    {
        return $this->belongsTo(Status::class);
    }
}
