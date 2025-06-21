<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'requirements',
        'responsibilities',
        'location',
        'type',
        'category',
        'status',
        'salary_min',
        'salary_max',
        'salary_currency',
        'experience_level',
        'education_level',
        'employment_type',
        'remote_allowed',
        'expires_at',
        'featured',
        'urgent',
        'views',
        'external_url',
        'how_to_apply',
        'benefits',
        'company_culture',
        'growth_opportunities',
        'technologies_used',
        'skills_required',
        'nice_to_have_skills',
        'is_internship',
        'internship_duration',
        'internship_stipend',
        'start_date',
        'application_deadline',
        'contact_email',
        'contact_phone',
        'admin_notes',
        'approved_at',
        'approved_by',
        'rejected_at',
        'rejected_by',
        'featured_until',
        'seo_title',
        'seo_description',
        'application_count',
        'click_count',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'featured_until' => 'datetime',
        'start_date' => 'datetime',
        'application_deadline' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'salary_min' => 'integer',
        'salary_max' => 'integer',
        'featured' => 'boolean',
        'urgent' => 'boolean',
        'remote_allowed' => 'boolean',
        'is_internship' => 'boolean',
        'internship_stipend' => 'integer',
        'views' => 'integer',
        'application_count' => 'integer',
        'click_count' => 'integer',
        'benefits' => 'array',
        'technologies_used' => 'array',
        'skills_required' => 'array',
        'nice_to_have_skills' => 'array',
    ];

    protected $attributes = [
        'status' => 'pending',
        'type' => 'full-time',
        'salary_currency' => 'EUR',
        'featured' => false,
        'urgent' => false,
        'remote_allowed' => false,
        'is_internship' => false,
        'views' => 0,
        'application_count' => 0,
        'click_count' => 0,
    ];

    // Relationships
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_skills')->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(JobCategory::class, 'job_job_categories')->withTimestamps();
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(JobFavorite::class);
    }

    // Status Management Methods
    public function approve(User $admin): bool
    {
        return $this->update([
            'status' => 'active',
            'approved_at' => now(),
            'approved_by' => $admin->id,
            'rejected_at' => null,
            'rejected_by' => null,
        ]);
    }

    public function reject(User $admin, ?string $notes = null): bool
    {
        return $this->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => $admin->id,
            'approved_at' => null,
            'approved_by' => null,
            'admin_notes' => $notes,
        ]);
    }

    public function activate(): bool
    {
        return $this->update(['status' => 'active']);
    }

    public function deactivate(): bool
    {
        return $this->update(['status' => 'inactive']);
    }

    public function markAsExpired(): bool
    {
        return $this->update(['status' => 'expired']);
    }

    public function feature(?Carbon $until = null): bool
    {
        return $this->update([
            'featured' => true,
            'featured_until' => $until,
        ]);
    }

    public function unfeature(): bool
    {
        return $this->update([
            'featured' => false,
            'featured_until' => null,
        ]);
    }

    // Status Checking Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired' || 
               ($this->expires_at && $this->expires_at->isPast());
    }

    public function isFeatured(): bool
    {
        return $this->featured && 
               (!$this->featured_until || $this->featured_until->isFuture());
    }

    public function isUrgent(): bool
    {
        return $this->urgent;
    }

    public function isInternship(): bool
    {
        return $this->is_internship;
    }

    public function allowsRemote(): bool
    {
        return $this->remote_allowed;
    }

    // Attribute Accessors
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'active' => 'green',
            'pending' => 'yellow',
            'inactive' => 'gray',
            'rejected' => 'red',
            'expired' => 'orange',
            default => 'gray'
        };
    }

    public function getFormattedSalaryAttribute(): ?string
    {
        if (!$this->salary_min && !$this->salary_max) {
            return null;
        }

        $currency = $this->salary_currency;
        
        if ($this->salary_min && $this->salary_max) {
            return "{$currency} " . number_format($this->salary_min) . " - " . number_format($this->salary_max);
        } elseif ($this->salary_min) {
            return "{$currency} " . number_format($this->salary_min) . "+";
        } else {
            return "{$currency} " . number_format($this->salary_max);
        }
    }

    public function getApplicationsCountAttribute(): int
    {
        return $this->applications()->count();
    }

    public function getRecentApplicationsCountAttribute(): int
    {
        return $this->applications()
                    ->where('created_at', '>=', now()->subDays(7))
                    ->count();
    }

    public function getApplicationSuccessRateAttribute(): float
    {
        $total = $this->applications_count;
        if ($total === 0) return 0;
        
        $successful = $this->applications()
                          ->whereIn('status', ['accepted', 'hired'])
                          ->count();
        
        return round(($successful / $total) * 100, 2);
    }

    public function getDaysActiveAttribute(): int
    {
        if ($this->status !== 'active') return 0;
        
        $activeDate = $this->approved_at ?: $this->created_at;
        return $activeDate->diffInDays(now());
    }

    public function getDaysUntilExpiryAttribute(): ?int
    {
        if (!$this->expires_at) return null;
        
        return now()->diffInDays($this->expires_at, false);
    }

    public function getIsCloseToExpiryAttribute(): bool
    {
        return $this->days_until_expiry !== null && 
               $this->days_until_expiry <= 7 && 
               $this->days_until_expiry >= 0;
    }

    public function getTypeDisplayAttribute(): string
    {
        return match($this->type) {
            'full-time' => 'Full Time',
            'part-time' => 'Part Time',
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship',
            'temporary' => 'Temporary',
            default => ucfirst($this->type)
        };
    }

    public function getExperienceLevelDisplayAttribute(): string
    {
        return match($this->experience_level) {
            'entry' => 'Entry Level',
            'junior' => 'Junior Level',
            'mid' => 'Mid Level',
            'senior' => 'Senior Level',
            'lead' => 'Lead Level',
            'executive' => 'Executive Level',
            default => ucfirst($this->experience_level ?? 'Not Specified')
        };
    }

    // Utility Methods
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function incrementClicks(): void
    {
        $this->increment('click_count');
    }

    public function hasApplied(Student $student): bool
    {
        return $this->applications()
                    ->where('student_id', $student->id)
                    ->exists();
    }

    public function isFavoritedBy(User $user): bool
    {
        return $this->favorites()
                    ->where('user_id', $user->id)
                    ->exists();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
                    ->orWhere('expires_at', '<', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true)
                    ->where(function($q) {
                        $q->whereNull('featured_until')
                          ->orWhere('featured_until', '>', now());
                    });
    }

    public function scopeUrgent($query)
    {
        return $query->where('urgent', true);
    }

    public function scopeRemote($query)
    {
        return $query->where('remote_allowed', true);
    }

    public function scopeInternships($query)
    {
        return $query->where('is_internship', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByExperienceLevel($query, $level)
    {
        return $query->where('experience_level', $level);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', "%{$location}%");
    }

    public function scopeBySalaryRange($query, $min, $max)
    {
        return $query->where(function($q) use ($min, $max) {
            $q->whereBetween('salary_min', [$min, $max])
              ->orWhereBetween('salary_max', [$min, $max])
              ->orWhere(function($subQ) use ($min, $max) {
                  $subQ->where('salary_min', '<=', $min)
                       ->where('salary_max', '>=', $max);
              });
        });
    }

    public function scopeByCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeExpiringWithin($query, $days = 7)
    {
        return $query->where('expires_at', '<=', now()->addDays($days))
                    ->where('expires_at', '>', now());
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('requirements', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhereHas('company', function($companyQuery) use ($search) {
                  $companyQuery->where('name', 'like', "%{$search}%");
              });
        });
    }

    public function scopeWithSkill($query, $skillName)
    {
        return $query->whereHas('skills', function($q) use ($skillName) {
            $q->where('name', 'like', "%{$skillName}%");
        });
    }

    public function scopePopular($query)
    {
        return $query->orderByDesc('views')
                    ->orderByDesc('application_count');
    }

    // Boot Method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($job) {
            // Set default expiry date if not provided
            if (!$job->expires_at) {
                $job->expires_at = now()->addDays(30);
            }
            
            // Set default application deadline
            if (!$job->application_deadline) {
                $job->application_deadline = $job->expires_at;
            }
        });

        // Auto-expire jobs
        static::updating(function ($job) {
            if ($job->expires_at && $job->expires_at->isPast() && $job->status === 'active') {
                $job->status = 'expired';
            }
        });
    }
}