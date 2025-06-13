<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'job_id',
        'status',
        'cover_letter',
        'resume_url',
        'portfolio_url',
        'additional_documents',
        'notes',
        'interview_date',
        'interview_type',
        'interview_location',
        'interview_notes',
    ];

    protected $casts = [
        'additional_documents' => 'array',
        'interview_date' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
} 