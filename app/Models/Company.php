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
    ];

    protected $casts = [
        'office_photos' => 'array',
        'onboarding_completed' => 'boolean',
        'profile_completed_at' => 'datetime',
        'founded_year' => 'integer',
    ];

    // Relationships
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

    // Add this new relationship for saved students
    public function savedStudents(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'company_saved_students')
                    ->withTimestamps();
    }

    // Accessors & Mutators
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
        // Add verification logic here
        return $this->profile_completeness >= 80 && $this->onboarding_completed;
    }

    // Scopes
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
}
        'name',
        'description',
        'website',
        'email',
        'logo_path',
        'is_active',
        'participating_in_career_launch',
        'tags'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'participating_in_career_launch' => 'boolean',
        'tags' => 'array'
    ];

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

    public function isFavoritedBy(User $user): bool
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
} 