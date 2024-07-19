<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TravelInspiration extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_code',
        'title',
        'image_url',
        'html_content',
        'destination_id',
        'travel_inspiration_slug_id',
    ];

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

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function slug()
    {
        return $this->belongsTo(TravelInspirationSlug::class, 'travel_inspiration_slug_id', 'id');
    }
}
