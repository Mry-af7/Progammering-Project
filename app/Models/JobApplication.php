<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'student_id',
        'user_id', // Redundant but useful for quick queries
        'status',
        'cover_letter',
        'resume_path',
        'portfolio_url',
        'additional_documents',
        'expected_salary',
        'available_start_date',
        'motivation',
        'why_company',
        'relevant_experience',
        'additional_info',
        'source', // Where they found the job
        'referral_name',
        'consent_data_processing',
        'consent_marketing',
        'application_stage',
        'admin_notes',
        'company_notes',
        'hr_rating',
        'technical_rating',
        'cultural_fit_rating',
        'overall_rating',
        'rejection_reason',
        'feedback_given',
        'interview_scheduled_at',
        'interview_completed_at',
        'offer_made_at',
        'offer_accepted_at',
        'offer_rejected_at',
        'start_date_confirmed',
        'responded_at',
        'last_contact_at',
        'follow_up_date',
        'archived_at',
        'archived_by',
    ];

    protected $casts = [
        'additional_documents' => 'array',
        'expected_salary' => 'integer',
        'available_start_date' => 'date',
        'consent_data_processing' => 'boolean',
        'consent_marketing' => 'boolean',
        'hr_rating' => 'integer',
        'technical_rating' => 'integer',
        'cultural_fit_rating' => 'integer',
        'overall_rating' => 'decimal:2',
        'interview_scheduled_at' => 'datetime',
        'interview_completed_at' => 'datetime',
        'offer_made_at' => 'datetime',
        'offer_accepted_at' => 'datetime',
        'offer_rejected_at' => 'datetime',
        'start_date_confirmed' => 'date',
        'responded_at' => 'datetime',
        'last_contact_at' => 'datetime',
        'follow_up_date' => 'datetime',
        'archived_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
        'application_stage' => 'applied',
        'consent_data_processing' => true,
        'consent_marketing' => false,
    ];

    // Relationships
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->through('job');
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(ApplicationNote::class);
    }

    public function archivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'archived_by');
    }

    // Status Management Methods
    public function review(): bool
    {
        return $this->update([
            'status' => 'reviewing',
            'application_stage' => 'under_review',
            'responded_at' => now(),
        ]);
    }

    public function shortlist(): bool
    {
        return $this->update([
            'status' => 'shortlisted',
            'application_stage' => 'shortlisted',
            'responded_at' => now(),
        ]);
    }

    public function scheduleInterview(?string $datetime = null): bool
    {
        return $this->update([
            'status' => 'interview_scheduled',
            'application_stage' => 'interview',
            'interview_scheduled_at' => $datetime ? now()->parse($datetime) : now(),
            'responded_at' => now(),
        ]);
    }

    public function completeInterview(): bool
    {
        return $this->update([
            'status' => 'interview_completed',
            'application_stage' => 'interview_completed',
            'interview_completed_at' => now(),
        ]);
    }

    public function makeOffer(): bool
    {
        return $this->update([
            'status' => 'offer_made',
            'application_stage' => 'offer',
            'offer_made_at' => now(),
        ]);
    }

    public function acceptOffer(): bool
    {
        return $this->update([
            'status' => 'offer_accepted',
            'application_stage' => 'hired',
            'offer_accepted_at' => now(),
        ]);
    }

    public function rejectOffer(?string $reason = null): bool
    {
        return $this->update([
            'status' => 'offer_rejected',
            'application_stage' => 'offer_rejected',
            'offer_rejected_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }

    public function reject(?string $reason = null, ?string $stage = null): bool
    {
        return $this->update([
            'status' => 'rejected',
            'application_stage' => $stage ?: 'rejected',
            'rejection_reason' => $reason,
            'responded_at' => now(),
        ]);
    }

    public function withdraw(): bool
    {
        return $this->update([
            'status' => 'withdrawn',
            'application_stage' => 'withdrawn',
        ]);
    }

    public function archive(User $user): bool
    {
        return $this->update([
            'archived_at' => now(),
            'archived_by' => $user->id,
        ]);
    }

    public function unarchive(): bool
    {
        return $this->update([
            'archived_at' => null,
            'archived_by' => null,
        ]);
    }

    // Status Checking Methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isReviewing(): bool
    {
        return $this->status === 'reviewing';
    }

    public function isShortlisted(): bool
    {
        return $this->status === 'shortlisted';
    }

    public function isInterviewScheduled(): bool
    {
        return $this->status === 'interview_scheduled';
    }

    public function isInterviewCompleted(): bool
    {
        return $this->status === 'interview_completed';
    }

    public function isOfferMade(): bool
    {
        return $this->status === 'offer_made';
    }

    public function isOfferAccepted(): bool
    {
        return $this->status === 'offer_accepted';
    }

    public function isOfferRejected(): bool
    {
        return $this->status === 'offer_rejected';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isWithdrawn(): bool
    {
        return $this->status === 'withdrawn';
    }

    public function isHired(): bool
    {
        return $this->status === 'offer_accepted' || $this->application_stage === 'hired';
    }

    public function isArchived(): bool
    {
        return !is_null($this->archived_at);
    }

    public function isActive(): bool
    {
        return !$this->isRejected() && 
               !$this->isWithdrawn() && 
               !$this->isOfferRejected() && 
               !$this->isArchived();
    }

    // Attribute Accessors
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'reviewing' => 'blue',
            'shortlisted' => 'purple',
            'interview_scheduled' => 'indigo',
            'interview_completed' => 'cyan',
            'offer_made' => 'green',
            'offer_accepted' => 'emerald',
            'offer_rejected' => 'orange',
            'rejected' => 'red',
            'withdrawn' => 'gray',
            default => 'gray'
        };
    }

    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending Review',
            'reviewing' => 'Under Review',
            'shortlisted' => 'Shortlisted',
            'interview_scheduled' => 'Interview Scheduled',
            'interview_completed' => 'Interview Completed',
            'offer_made' => 'Offer Made',
            'offer_accepted' => 'Offer Accepted',
            'offer_rejected' => 'Offer Rejected',
            'rejected' => 'Rejected',
            'withdrawn' => 'Withdrawn',
            default => ucfirst($this->status)
        };
    }

    public function getStageDisplayAttribute(): string
    {
        return match($this->application_stage) {
            'applied' => 'Applied',
            'under_review' => 'Under Review',
            'shortlisted' => 'Shortlisted',
            'interview' => 'Interview Stage',
            'interview_completed' => 'Interview Completed',
            'offer' => 'Offer Stage',
            'hired' => 'Hired',
            'rejected' => 'Rejected',
            'withdrawn' => 'Withdrawn',
            'offer_rejected' => 'Offer Declined',
            default => ucfirst(str_replace('_', ' ', $this->application_stage))
        };
    }

    public function getDaysInCurrentStageAttribute(): int
    {
        $lastUpdate = $this->responded_at ?: $this->updated_at;
        return $lastUpdate->diffInDays(now());
    }

    public function getDaysSinceApplicationAttribute(): int
    {
        return $this->created_at->diffInDays(now());
    }

    public function getResponseTimeAttribute(): ?int
    {
        if (!$this->responded_at) return null;
        
        return $this->created_at->diffInHours($this->responded_at);
    }

    public function getAverageRatingAttribute(): ?float
    {
        $ratings = array_filter([
            $this->hr_rating,
            $this->technical_rating,
            $this->cultural_fit_rating
        ]);

        if (empty($ratings)) return null;

        return round(array_sum($ratings) / count($ratings), 2);
    }

    public function getFormattedExpectedSalaryAttribute(): ?string
    {
        if (!$this->expected_salary) return null;

        return '€ ' . number_format($this->expected_salary);
    }

    // Utility Methods
    public function canBeWithdrawn(): bool
    {
        return $this->isActive() && 
               !$this->isOfferAccepted() && 
               !$this->isHired();
    }

    public function canBeRejected(): bool
    {
        return $this->isActive() && 
               !$this->isOfferAccepted() && 
               !$this->isHired();
    }

    public function needsResponse(): bool
    {
        return $this->isPending() && 
               $this->created_at->diffInDays(now()) >= 7;
    }

    public function isOverdue(): bool
    {
        if ($this->follow_up_date) {
            return now()->gt($this->follow_up_date);
        }

        // Consider applications overdue if pending for more than 14 days
        return $this->isPending() && 
               $this->created_at->diffInDays(now()) >= 14;
    }

    public function updateLastContact(): void
    {
        $this->update(['last_contact_at' => now()]);
    }

    public function setFollowUpDate(int $days): void
    {
        $this->update(['follow_up_date' => now()->addDays($days)]);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeReviewing($query)
    {
        return $query->where('status', 'reviewing');
    }

    public function scopeShortlisted($query)
    {
        return $query->where('status', 'shortlisted');
    }

    public function scopeInterviewStage($query)
    {
        return $query->whereIn('status', ['interview_scheduled', 'interview_completed']);
    }

    public function scopeOfferStage($query)
    {
        return $query->whereIn('status', ['offer_made', 'offer_accepted', 'offer_rejected']);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeHired($query)
    {
        return $query->where('status', 'offer_accepted')
                    ->orWhere('application_stage', 'hired');
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['rejected', 'withdrawn', 'offer_rejected'])
                    ->whereNull('archived_at');
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeOverdue($query)
    {
        return $query->where(function($q) {
            $q->where('follow_up_date', '<', now())
              ->orWhere(function($subQ) {
                  $subQ->where('status', 'pending')
                       ->where('created_at', '<', now()->subDays(14));
              });
        });
    }

    public function scopeNeedsResponse($query)
    {
        return $query->where('status', 'pending')
                    ->where('created_at', '<', now()->subDays(7));
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByStage($query, $stage)
    {
        return $query->where('application_stage', $stage);
    }

    public function scopeByJob($query, $jobId)
    {
        return $query->where('job_id', $jobId);
    }

    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeByCompany($query, $companyId)
    {
        return $query->whereHas('job', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        });
    }

    public function scopeWithRating($query, $minRating = 3)
    {
        return $query->whereNotNull('overall_rating')
                    ->where('overall_rating', '>=', $minRating);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('cover_letter', 'like', "%{$search}%")
              ->orWhere('motivation', 'like', "%{$search}%")
              ->orWhereHas('student', function($studentQuery) use ($search) {
                  $studentQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
              })
              ->orWhereHas('job', function($jobQuery) use ($search) {
                  $jobQuery->where('title', 'like', "%{$search}%");
              });
        });
    }

    // Boot Method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($application) {
            // Set user_id for quick queries
            if (!$application->user_id && $application->student) {
                $application->user_id = $application->student->user_id;
            }
        });

        static::created(function ($application) {
            // Increment application count on job
            $application->job->increment('application_count');
        });

        static::deleted(function ($application) {
            // Decrement application count on job
            $application->job->decrement('application_count');
        });
    }
}