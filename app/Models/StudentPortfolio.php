<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'url'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}