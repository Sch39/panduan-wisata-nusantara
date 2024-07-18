<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'avg_rating'
    ];

    public function votes()
    {
        return $this->hasMany(DestinationVote::class, 'destination_id', 'destination_id');
    }
}
