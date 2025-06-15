<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'study_field_id',
        'bio',
        'technical_skills',
        'soft_skills',
        'languages',
        'portfolio_url',
        'linkedin_url',
        'github_url',
        'cv_url',
        'profile_image',
        'graduation_year',
        'current_education_level',
        'preferred_job_types',
        'preferred_work_location',
        'preferred_company_size',
        'preferred_industries',
        'availability_status',
    ];

    protected $casts = [
        'technical_skills' => 'array',
        'soft_skills' => 'array',
        'languages' => 'array',
        'preferred_job_types' => 'array',
        'preferred_work_location' => 'array',
        'preferred_company_size' => 'array',
        'preferred_industries' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studyField(): BelongsTo
    {
        return $this->belongsTo(StudyField::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function studentSkills(): HasMany
    {
        return $this->hasMany(StudentSkill::class);
    }
} 