<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'company_id',
        'start_time',
        'end_time',
        'duration',
        'max_students',
        'current_students',
        'status',
        'location',
        'room_number'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'max_students' => 'integer',
        'current_students' => 'integer'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function isAvailable()
    {
        return $this->status === 'available' && 
               $this->current_students < $this->max_students &&
               $this->start_time > now();
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
        return $query->where('status', 'available')
                    ->where('current_students', '<', DB::raw('max_students'))
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