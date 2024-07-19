<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

        static::saved(function () {
            Cache::forget('destinations');
            Cache::forget('travel_inspirations');
        });
        static::updated(function () {
            Cache::forget('destinations');
            Cache::forget('travel_inspirations');
        });

        static::deleted(function () {
            Cache::forget('destinations');
            Cache::forget('travel_inspirations');
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
