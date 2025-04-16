<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseName extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'active'];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
