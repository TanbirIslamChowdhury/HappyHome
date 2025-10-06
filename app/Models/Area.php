<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name', 'latitude', 'longitude'];

    public function pickupBookings()
    {
        return $this->hasMany(BookingDetail::class, 'pickup_area_id');
    }

    public function deliveryBookings()
    {
        return $this->hasMany(BookingDetail::class, 'delivery_area_id');
    }

    public function fromDistances()
    {
        return $this->hasMany(AreaDistance::class, 'from_area_id');
    }

    public function toDistances()
    {
        return $this->hasMany(AreaDistance::class, 'to_area_id');
    }
}
