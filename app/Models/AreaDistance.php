<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaDistance extends Model
{
    protected $fillable = ['from_area_id', 'to_area_id', 'distance_km'];

    public function fromArea()
    {
        return $this->belongsTo(Area::class, 'from_area_id');
    }

    public function toArea()
    {
        return $this->belongsTo(Area::class, 'to_area_id');
    }
}
