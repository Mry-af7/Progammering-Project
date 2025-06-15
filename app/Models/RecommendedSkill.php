<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendedSkill extends Model
{
    protected $fillable = [
        'name',
        'demand',
        'category',
    ];
} 