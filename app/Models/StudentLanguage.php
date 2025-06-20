<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLanguage extends Model
{
    protected $fillable = [
        'student_id',
        'language_id',
        'fluency_level'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}