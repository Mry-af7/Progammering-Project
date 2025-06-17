<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_completion_percentage',
        'applications_sent',
        'applications_pending',
        'applications_interview',
        'applications_offers',
        'profile_views_count'
    ];

    protected $casts = [
        'profile_completion_percentage' => 'integer',
        'applications_sent' => 'integer',
        'applications_pending' => 'integer',
        'applications_interview' => 'integer',
        'applications_offers' => 'integer',
        'profile_views_count' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 