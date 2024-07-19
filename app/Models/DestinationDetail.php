<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class DestinationDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_code',
        'title',
        'image_url',
        'description',
        'html_content',
        'destination_id',
        'regency_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('destinations');
            Cache::forget('destination_provinces');
            Cache::forget('travel_inspirations');
        });
        static::updated(function () {
            Cache::forget('destinations');
            Cache::forget('destination_provinces');
            Cache::forget('travel_inspirations');
        });

        static::deleted(function () {
            Cache::forget('destinations');
            Cache::forget('destination_provinces');
            Cache::forget('travel_inspirations');
        });
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
