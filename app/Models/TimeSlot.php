<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'company_id',
        'start_time',
        'end_time',
        'is_available',
        'duration_minutes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_available' => 'boolean'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }

    public function isAvailable(): bool
    {
        return $this->is_available && !$this->appointment()->exists() && $this->start_time > now();
    }

    public function isFull()
    {
        return $this->current_students >= $this->max_students;
    }

    public function incrementStudents()
    {
        $this->increment('current_students');
        if ($this->isFull()) {
            $this->update(['status' => 'booked']);
        }
    }

    public function decrementStudents()
    {
        $this->decrement('current_students');
        if ($this->current_students < $this->max_students) {
            $this->update(['status' => 'available']);
        }
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
                    ->whereDoesntHave('appointment')
                    ->where('start_time', '>', now());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('end_time', '<', now());
    }
} 