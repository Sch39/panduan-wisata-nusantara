<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function slug()
    {
        return $this->belongsTo(TravelInspirationSlug::class);
    }
}
