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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($destination) {
            $destination->rating()->create(['destination_id' => $destination->id]);
        });
    }

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

    public function destinationDetails()
    {
        return $this->hasMany(DestinationDetail::class);
    }
}
