<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'university_name_id',
        'state_id',
    ];

    public function university()
    {
        return $this->belongsTo(UniversityName::class, 'university_name_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function courseName()
    {
        return $this->belongsTo(CourseName::class, 'course_name_id');
    }
}
