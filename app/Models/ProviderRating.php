<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderRating extends Model
{
    protected $fillable = ['provider_id', 'average_rating', 'total_reviews'];

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }
}
