<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name','email','city','phone','cnic','created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
