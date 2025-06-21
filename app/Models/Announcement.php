<?php

// File: app/Models/Announcement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'priority',
        'is_active',
        'show_on_dashboard',
        'show_on_homepage',
        'target_audience',
        'expires_at',
        'starts_at',
        'action_url',
        'action_text',
        'dismissible',
        'views',
        'clicks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_on_dashboard' => 'boolean',
        'show_on_homepage' => 'boolean',
        'dismissible' => 'boolean',
        'expires_at' => 'datetime',
        'starts_at' => 'datetime',
        'views' => 'integer',
        'clicks' => 'integer',
        'priority' => 'integer',
        'target_audience' => 'array',
    ];

    protected $attributes = [
        'type' => 'info',
        'priority' => 1,
        'is_active' => true,
        'show_on_dashboard' => true,
        'show_on_homepage' => false,
        'dismissible' => true,
        'views' => 0,
        'clicks' => 0,
    ];

    // Relationships
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Accessors
    public function getTypeBadgeColorAttribute(): string
    {
        return match($this->type) {
            'info' => 'blue',
            'success' => 'green',
            'warning' => 'yellow',
            'error' => 'red',
            'urgent' => 'red',
            default => 'gray'
        };
    }

    public function getIsCurrentAttribute(): bool
    {
        $now = now();
        
        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }
        
        if ($this->expires_at && $now->gt($this->expires_at)) {
            return false;
        }
        
        return true;
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && now()->gt($this->expires_at);
    }

    public function getIsScheduledAttribute(): bool
    {
        return $this->starts_at && now()->lt($this->starts_at);
    }

    // Methods
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }

    public function isVisibleTo(User $user): bool
    {
        if (!$this->is_active || !$this->is_current) {
            return false;
        }

        if (empty($this->target_audience)) {
            return true;
        }

        return in_array($user->user_type, $this->target_audience) || 
               in_array('all', $this->target_audience);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        $now = now();
        return $query->where(function($q) use ($now) {
            $q->where(function($subQ) use ($now) {
                $subQ->whereNull('starts_at')
                     ->orWhere('starts_at', '<=', $now);
            })
            ->where(function($subQ) use ($now) {
                $subQ->whereNull('expires_at')
                     ->orWhere('expires_at', '>', $now);
            });
        });
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    public function scopeScheduled($query)
    {
        return $query->where('starts_at', '>', now());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeForDashboard($query)
    {
        return $query->where('show_on_dashboard', true);
    }

    public function scopeForHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }

    public function scopeForAudience($query, $audience)
    {
        return $query->where(function($q) use ($audience) {
            $q->whereJsonContains('target_audience', $audience)
              ->orWhereJsonContains('target_audience', 'all')
              ->orWhereNull('target_audience')
              ->orWhereJsonLength('target_audience', 0);
        });
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', '>=', 3);
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('priority')
                    ->orderByDesc('created_at');
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($announcement) {
            if (!$announcement->starts_at) {
                $announcement->starts_at = now();
            }
        });
    }
}

