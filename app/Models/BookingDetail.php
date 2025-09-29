<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id', 'area_sqft', 'hours', 'distance_km',
        'pickup_area_id', 'delivery_area_id', 'pickup_floor',
        'delivery_floor', 'notes'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function pickupArea()
    {
        return $this->belongsTo(Area::class, 'pickup_area_id');
    }

    public function deliveryArea()
    {
        return $this->belongsTo(Area::class, 'delivery_area_id');
    }
}
