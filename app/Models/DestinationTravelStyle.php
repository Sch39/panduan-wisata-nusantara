<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationTravelStyle extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'travel_style_id'
    ];
}
