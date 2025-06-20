<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CompanyTechnology extends Model
{
    protected $fillable = [
        'name',
        'category', 
        'icon',
        'color'
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_company_technology');
    }
}