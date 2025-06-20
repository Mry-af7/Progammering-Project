<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'study_field_id',
        'firstname',
        'lastname',
        'email',
        'major',
        'year_of_study',
        'about_me',
        'linkedin_url',
        'github_link',
        'custom_link_title',
        'custom_link_url',
        'technical_skills',
        'soft_skills',
        'cv_url',
        'graduation_year',
        'current_education_level',
        'preferred_job_types',
        'preferred_work_location',
        'preferred_company_size',
        'preferred_industries',
        'availability_status',
        'profile_completed'
    ];

    protected $casts = [
        'technical_skills' => 'array',
        'soft_skills' => 'array',
        'preferred_job_types' => 'array',
        'preferred_work_location' => 'array',
        'preferred_company_size' => 'array',
        'preferred_industries' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'student_skills')
                    ->withPivot('proficiency_level')
                    ->withTimestamps();
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'student_languages')
                    ->withPivot('fluency_level')
                    ->withTimestamps();
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'student_hobbies')
                    ->withTimestamps();
    }

    public function portfolios()
    {
        return $this->hasMany(StudentPortfolio::class);
    }
}