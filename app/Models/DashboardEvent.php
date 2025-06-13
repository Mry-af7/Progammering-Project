<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DashboardEvent extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'event_date',
        'location',
        'icon',
        'is_today'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_today' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 