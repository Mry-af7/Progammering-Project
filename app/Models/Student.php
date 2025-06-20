<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email', 
        'major',
        'github_link',
        'year_of_study',
        'linkedin_url',
        'custom_link_url',
        'custom_link_title',
        'about_me',
        'profile_completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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