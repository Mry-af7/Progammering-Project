<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSkill extends Model
{
    protected $fillable = [
        'student_id',
        'skill_id', 
        'proficiency_level'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}