<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'event_type',
        'start_date',
        'end_date',
        'location',
        'online_meeting_link',
        'max_participants',
        'registration_deadline',
        'status',
        'image',
        'requirements',
        'benefits',
        'target_audience',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'requirements' => 'array',
        'benefits' => 'array',
        'target_audience' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(EventParticipant::class);
    }
} 