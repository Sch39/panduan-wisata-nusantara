<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'language_code',
        'provinces_code',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinces_code', 'code');
    }

    public function destinationDetails()
    {
        return $this->hasMany(DestinationDetail::class);
    }
}
