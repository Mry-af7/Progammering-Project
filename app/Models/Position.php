<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'requirements',
        'location',
        'type',
        'salary_min',
        'salary_max',
        'is_active',
        'application_deadline'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'application_deadline' => 'datetime',
        'salary_min' => 'integer',
        'salary_max' => 'integer'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
} 