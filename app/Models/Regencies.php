<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'language_code',
        'provinces_code',
    ];
}
