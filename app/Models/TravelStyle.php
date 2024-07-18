<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelStyle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'destination_travel_style');
    }
}
