<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_id',
        'study_level_id',
        'course_name_id',
        'name',
        'annual_fee',
        'study_mode',
        'duration',
        'start_date',
        'accreditation',
        'regional_area',
        'country_requirement',
        'regional_requirement',
        'pathway_to_visa',
        'admmision_req',
    ];

    public function studyLevel()
    {
        return $this->belongsTo(StudyLevel::class);
    }

    public function courseName()
    {
        return $this->belongsTo(CourseName::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
