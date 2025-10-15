<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id', 'service_id', 'area_from', 'area_to', 'area_sqft', 'hours', 'distance',
         'base_price', 'unit_price', 'service_price', 'provider_id', 'status', 'booking_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function package()
    {
        return $this->belongsTo(ServicePackage::class, 'service_package_id');
    }

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function details()
    {
        return $this->hasOne(BookingDetail::class, 'booking_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'booking_id');
    }
}
