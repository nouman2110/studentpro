<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnglishRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'study_level_id',
        'test_name', // e.g., IELTS, TOEFL, etc.
        'minimum_score', // Minimum score required
        'validity_period', // e.g., 2 years
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
    public function studyLevel()
    {
        return $this->belongsTo(StudyLevel::class, 'study_level_id');
    }
}
