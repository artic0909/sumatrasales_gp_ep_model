<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'url',
        'method',
        'user_agent',
        'device',
        'browser',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Scope for today's visits.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('visited_at', today('Asia/Kolkata'));
    }

    /**
     * Scope for last N days.
     */
    public function scopeLastDays($query, int $days = 7)
    {
        return $query->where('visited_at', '>=', now('Asia/Kolkata')->subDays($days));
    }
}
