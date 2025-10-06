<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'billing_type'];

    public function packages()
    {
        return $this->hasMany(ServicePackage::class, 'service_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id');
    }
}
