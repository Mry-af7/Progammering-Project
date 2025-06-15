<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_slot_id',
        'student_firstname',
        'student_lastname',
        'student_email',
        'student_phone',
        'study_field',
        'study_year',
        'student_notes',
        'status',
        'rating',
        'feedback',
        'follow_up_requested',
        'follow_up_notes'
    ];

    protected $casts = [
        'follow_up_requested' => 'boolean',
        'study_year' => 'integer',
        'rating' => 'integer'
    ];

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function company()
    {
        return $this->hasOneThrough(Company::class, TimeSlot::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function confirm()
    {
        $this->update(['status' => 'confirmed']);
    }

    public function cancel()
    {
        $this->update(['status' => 'cancelled']);
        $this->timeSlot->update(['status' => 'available']);
    }

    public function complete()
    {
        $this->update(['status' => 'completed']);
    }

    public function requestFollowUp($notes = null)
    {
        $this->update([
            'follow_up_requested' => true,
            'follow_up_notes' => $notes
        ]);
    }
} 