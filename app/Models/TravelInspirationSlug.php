<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelInspirationSlug extends Model
{
    use HasFactory;
    protected $fillable = ['slug'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('travel_inspirations');
        });
        static::updated(function () {
            Cache::forget('travel_inspirations');
        });

        static::deleted(function () {
            Cache::forget('travel_inspirations');
        });
    }

    public function travelInpirations()
    {
        return $this->hasMany(TravelInspiration::class);
    }
}
