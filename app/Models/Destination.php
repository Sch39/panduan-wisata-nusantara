<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
    ];

    public function travelStyles()
    {
        return $this->belongsToMany(TravelStyle::class, 'destination_travel_style');
    }

    public function votes()
    {
        return $this->hasMany(DestinationVote::class);
    }

    public function rating()
    {
        return $this->hasOne(DestinationRating::class);
    }
}
