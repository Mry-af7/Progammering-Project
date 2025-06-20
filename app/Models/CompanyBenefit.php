<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CompanyBenefit extends Model
{
    protected $fillable = [
        'name',
        'category', 
        'icon',
        'description'
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_company_benefit');
    }
}