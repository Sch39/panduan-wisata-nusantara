<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Session extends Model
{
    use Prunable;

    public $timestamps = false;
    protected $fillable = [
        'id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity',
    ];

    /**
     * Prune old sessions.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function pruning()
    {
        return static::where('last_activity', '<=', now()->subMonths(1)->getTimestamp());
    }
}
