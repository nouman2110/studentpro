<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'state_id',
        'group_id',
        'sector_id',
        'scholarship',
        'promotion',
        'university_name_id'
    ];
    public function university()
    {
        return $this->belongsTo(UniversityName::class, 'university_name_id');
    }

    public function country() 
    {
        return $this->belongsTo(Country::class);
    }

    public function state() 
    {
        return $this->belongsTo(State::class);
    }

    public function group() 
    {
        return $this->belongsTo(Group::class);
    }

    public function sector() 
    {
        return $this->belongsTo(Sector::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function commissions()
    {
        return $this->hasMany(Commissions::class);
    }

    public function studyLevels()
    {
        return $this->hasMany(StudyLevel::class);
    }

    public function territories()
    {
        return $this->belongsToMany(Territory::class, 'territory_university');
    }

    public function getTerritoryNamesAttribute()
    {
        return $this->territories()->pluck('name')->implode(', ');
    }

    public function englishRequirements()
    {
        return $this->hasMany(EnglishRequirement::class, 'university_id');
    }

}
