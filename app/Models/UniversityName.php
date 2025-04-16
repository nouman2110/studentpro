<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityName extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'qs_ranking',
        'location',
    ];

    public function schools()
    {
        return $this->hasMany(School::class, 'university_name_id');
    }
}
