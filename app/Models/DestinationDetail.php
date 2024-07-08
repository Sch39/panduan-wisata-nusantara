<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function destination()
    {
        return $this->belongsTo(Destinations::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
