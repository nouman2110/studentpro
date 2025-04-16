<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'university_id',
        'commission_percent',
        'study_level_id',
        'scholarship_amount'
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
