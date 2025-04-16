<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyLevel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'active'];
    public function courses()
    {
        return $this->hasMany(Course::class, 'study_level_id');
    }
    public function commissions()
    {
        return $this->hasMany(commissions::class, 'study_level_id');
    }

    public function englishRequirements()
    {
        return $this->hasMany(EnglishRequirement::class, 'study_level_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
