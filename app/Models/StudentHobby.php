<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentHobby extends Model
{
    protected $fillable = [
        'student_id',
        'hobby_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function hobby()
    {
        return $this->belongsTo(Hobby::class);
    }
}