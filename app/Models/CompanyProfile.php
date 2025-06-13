<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'website',
        'industry',
        'company_size',
        'founded_year',
        'headquarters',
        'logo',
        'banner_image',
        'company_type',
        'specializations',
        'benefits',
        'company_culture',
        'contact_email',
        'contact_phone',
        'social_media',
        'is_verified',
    ];

    protected $casts = [
        'specializations' => 'array',
        'benefits' => 'array',
        'social_media' => 'array',
        'is_verified' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function companyTags(): HasMany
    {
        return $this->hasMany(CompanyTag::class);
    }
} 