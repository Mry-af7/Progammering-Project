<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerGoal extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'progress',
        'target_date'
    ];

    protected $casts = [
        'target_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 