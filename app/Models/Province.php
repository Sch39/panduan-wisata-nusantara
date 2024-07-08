<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'language_code',
        'code',
    ];

    public function regencies()
    {
        return $this->hasMany(Regency::class, 'provinces_code', 'code');
    }
}
