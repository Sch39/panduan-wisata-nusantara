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
        'html_content',
        'destination_id',
        'regency_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('destinations');
        });
        static::updated(function () {
            Cache::forget('destinations');
        });

        static::deleted(function () {
            Cache::forget('destinations');
        });
    }

    public function destination()
    {
        return $this->belongsTo(Destinations::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
