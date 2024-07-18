<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelInspirationSlug extends Model
{
    use HasFactory;
    protected $fillable = ['slug'];

    public function travelInpirations()
    {
        return $this->hasMany(TravelInspiration::class);
    }
}
