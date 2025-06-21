<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'name',
        'email',
        'password',
        'role', // student, company, admin (keeping their naming)
        'user_type', // keeping yours for backward compatibility
        'profile_completed',
        'profile_photo_path',
        'bio',
        'phone',
        'address',
        'city',
        'postal_code',
        'is_admin',              // ADDED
        'admin_granted_at',      // ADDED
        'admin_granted_by',      // ADDED
        'email_verified_at',     // ADDED for email verification
        'last_login_at',         // ADDED for admin analytics
        'login_count',           // ADDED for admin analytics
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'admin_granted_at' => 'datetime',  // ADDED
            'is_admin' => 'boolean',           // ADDED
            'profile_completed' => 'boolean',  // ADDED
            'last_login_at' => 'datetime',     // ADDED
            'login_count' => 'integer',        // ADDED
        ];
    }

    /**
     * Get the user's activities.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    /**
     * Get the user's tasks.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(UserTask::class);
    }

    /**
     * Get the user's favorites.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Get the user's company profile.
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Get the user's student profile.
     */
    public function studentProfile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    /**
     * Alias for studentProfile to match admin controller expectations
     */
    public function student(): HasOne
    {
        return $this->studentProfile();
    }

    /**
     * Get the user's appointments.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the user's statistics.
     */
    public function userStats(): HasOne
    {
        return $this->hasOne(UserStats::class);
    }

    /**
     * Get the user's unread messages count.
     */
    public function unreadMessages(): HasMany
    {
        return $this->hasMany(Message::class)->where('read', false);
    }

    /**
     * Get the user who granted admin access
     */
    public function adminGrantedBy()
    {
        return $this->belongsTo(User::class, 'admin_granted_by');
    }

    /**
     * Users this admin has promoted
     */
    public function adminPromotions()
    {
        return $this->hasMany(User::class, 'admin_granted_by');
    }

    /**
     * Get jobs posted by this user (if company)
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class)->through('company');
    }

    /**
     * Get job applications by this user (if student)
     */
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class)->through('student');
    }

    /**
     * Scope to get only admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }

    /**
     * Scope to get only non-admin users
     */
    public function scopeRegularUsers($query)
    {
        return $query->where('is_admin', false);
    }

    /**
     * Scope to get users by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('user_type', $type)->orWhere('role', $type);
    }

    /**
     * Scope to get recent users
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope to get verified users
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope to get unverified users
     */
    public function scopeUnverified($query)
    {
        return $query->whereNull('email_verified_at');
    }

    // Role checking methods (supporting both naming conventions)
    public function isAdmin(): bool
    {
        // UPDATED: Check both is_admin field AND role field
        return $this->is_admin === true || $this->role === 'admin';
    }

    public function isCompany(): bool
    {
        return $this->role === 'company' || $this->user_type === 'company';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student' || $this->user_type === 'student';
    }

    /**
     * Get user's display name
     */
    public function getDisplayNameAttribute(): string
    {
        if ($this->name) {
            return $this->name;
        }
        
        if ($this->firstname && $this->lastname) {
            return $this->firstname . ' ' . $this->lastname;
        }
        
        return $this->email;
    }

    /**
     * Get user's profile completion percentage
     */
    public function getProfileCompletionAttribute(): int
    {
        $requiredFields = ['name', 'email', 'bio', 'phone'];
        $completedFields = 0;

        foreach ($requiredFields as $field) {
            if (!empty($this->$field)) {
                $completedFields++;
            }
        }

        // Check profile photo
        if (!empty($this->profile_photo_path)) {
            $completedFields++;
            $requiredFields[] = 'profile_photo_path';
        }

        return round(($completedFields / count($requiredFields)) * 100);
    }

    /**
     * Check if user has completed onboarding
     */
    public function hasCompletedOnboarding(): bool
    {
        if ($this->isAdmin()) {
            return true; // Admins don't need onboarding
        }

        if ($this->isCompany()) {
            return $this->company && $this->company->is_complete;
        }

        return $this->profile_completed;
    }

    /**
     * Promote user to admin
     */
    public function promoteToAdmin(?User $grantedBy = null): bool
    {
        return $this->update([
            'is_admin' => true,
            'admin_granted_at' => now(),
            'admin_granted_by' => $grantedBy?->id,
        ]);
    }

    /**
     * Revoke admin access
     */
    public function revokeAdmin(): bool
    {
        return $this->update([
            'is_admin' => false,
            'admin_granted_at' => null,
            'admin_granted_by' => null,
        ]);
    }

    /**
     * Update login tracking
     */
    public function updateLoginTracking(): void
    {
        $this->update([
            'last_login_at' => now(),
            'login_count' => $this->login_count + 1
        ]);
    }

    /**
     * Get user's status for admin dashboard
     */
    public function getStatusAttribute(): string
    {
        if ($this->isAdmin()) {
            return 'admin';
        }

        if (!$this->hasVerifiedEmail()) {
            return 'unverified';
        }

        if (!$this->hasCompletedOnboarding()) {
            return 'incomplete';
        }

        return 'active';
    }

    /**
     * Check if user has verified email
     */
    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Get the user's type in a standardized way
     */
    public function getUserTypeAttribute(): ?string
    {
        return $this->attributes['user_type'] ?? $this->role;
    }
}