<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'address'];

    protected $hidden = ['password'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'customer_id');
    }
}
