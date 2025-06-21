<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'industry_id',
        'company_size_id',
        'website',
        'founded_year',
        'headquarters',
        'description',
        'mission_statement',
        'company_culture',
        'remote_policy',
        'linkedin_url',
        'twitter_url',
        'glassdoor_url',
        'logo_url',
        'cover_image_url',
        'video_url',
        'office_photos',
        'onboarding_completed',
        'profile_completed_at',
        // From their version
        'logo_path',
        'is_active',
        'participating_in_career_launch',
        'tags',
        // NEW: Admin approval system
        'status',
        'approved_at',
        'rejected_at',
        'approved_by',
        'rejected_by',
        'admin_notes',
        'is_complete',
        // NEW: Additional tracking
        'location',
        'size',
        'phone',
    ];

    protected $casts = [
        'office_photos' => 'array',
        'onboarding_completed' => 'boolean',
        'profile_completed_at' => 'datetime',
        'founded_year' => 'integer',
        // From their version
        'is_active' => 'boolean',
        'participating_in_career_launch' => 'boolean',
        'tags' => 'array',
        // NEW: Admin approval system
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'is_complete' => 'boolean',
    ];

    // Default values
    protected $attributes = [
        'status' => 'pending',
        'is_active' => true,
        'is_complete' => false,
    ];

    // Your existing relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function companySize(): BelongsTo
    {
        return $this->belongsTo(CompanySize::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(CompanyTechnology::class, 'company_company_technology');
    }

    public function benefits(): BelongsToMany
    {
        return $this->belongsToMany(CompanyBenefit::class, 'company_company_benefit');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function savedStudents(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'company_saved_students')
                    ->withTimestamps();
    }

    // Their existing relationships
    public function timeSlots(): HasMany
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    // NEW: Admin approval relationships
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    // NEW: Job applications through jobs
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class)->through('jobs');
    }

    // Your existing methods
    public function getProfileCompletenessAttribute(): int
    {
        $fields = [
            'name' => $this->name,
            'industry_id' => $this->industry_id,
            'company_size_id' => $this->company_size_id,
            'description' => $this->description,
            'website' => $this->website,
            'headquarters' => $this->headquarters,
            'remote_policy' => $this->remote_policy,
            'logo_url' => $this->logo_url,
            'technologies' => $this->technologies->count() > 0,
            'benefits' => $this->benefits->count() > 0,
        ];

        $completed = array_filter($fields, fn($value) => !empty($value));
        
        return round((count($completed) / count($fields)) * 100);
    }

    public function getIsVerifiedAttribute(): bool
    {
        return $this->profile_completeness >= 80 && $this->onboarding_completed;
    }

    // Their existing methods
    public function isFavoritedBy(User $user): bool
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    // NEW: Admin approval methods
    public function approve(User $admin): bool
    {
        return $this->update([
            'status' => 'approved',
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

    public function markAsComplete(): bool
    {
        return $this->update([
            'is_complete' => true,
            'onboarding_completed' => true,
            'profile_completed_at' => now(),
        ]);
    }

    // NEW: Status checking methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    // NEW: Admin dashboard attributes
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'approved' => 'green',
            'rejected' => 'red',
            'pending' => 'yellow',
            default => 'gray'
        };
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: 'Unnamed Company';
    }

    public function getActiveJobsCountAttribute(): int
    {
        return $this->jobs()->where('status', 'active')->count();
    }

    public function getTotalApplicationsCountAttribute(): int
    {
        return $this->jobApplications()->count();
    }

    // Your existing scopes
    public function scopeVerified($query)
    {
        return $query->where('onboarding_completed', true)
                    ->whereNotNull('profile_completed_at');
    }

    public function scopeInIndustry($query, $industryId)
    {
        return $query->where('industry_id', $industryId);
    }

    public function scopeOfSize($query, $sizeId)
    {
        return $query->where('company_size_id', $sizeId);
    }

    public function scopeWithRemotePolicy($query, $policy)
    {
        return $query->where('remote_policy', $policy);
    }

    // NEW: Admin scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_complete', true);
    }

    public function scopeIncomplete($query)
    {
        return $query->where('is_complete', false);
    }

    public function scopeWithActiveJobs($query)
    {
        return $query->whereHas('jobs', function($q) {
            $q->where('status', 'active');
        });
    }

    public function scopeByIndustryName($query, $industryName)
    {
        return $query->whereHas('industry', function($q) use ($industryName) {
            $q->where('name', 'like', "%{$industryName}%");
        });
    }

    // NEW: Search scope for admin dashboard
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('website', 'like', "%{$search}%")
              ->orWhereHas('user', function($userQuery) use ($search) {
                  $userQuery->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
              });
        });
    }

    // NEW: Analytics methods for admin dashboard
    public function getRegistrationDaysAgoAttribute(): int
    {
        return $this->created_at->diffInDays(now());
    }

    public function getLastActivityAttribute(): ?string
    {
        $lastJob = $this->jobs()->latest()->first();
        $lastLogin = $this->user->last_login_at;
        
        if ($lastJob && $lastLogin) {
            return $lastJob->created_at->gt($lastLogin) 
                ? "Posted job {$lastJob->created_at->diffForHumans()}"
                : "Logged in {$lastLogin->diffForHumans()}";
        } elseif ($lastJob) {
            return "Posted job {$lastJob->created_at->diffForHumans()}";
        } elseif ($lastLogin) {
            return "Logged in {$lastLogin->diffForHumans()}";
        }
        
        return 'No recent activity';
    }

    // NEW: Boot method to set default status
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($company) {
            if (empty($company->status)) {
                $company->status = 'pending';
            }
        });
    }
}