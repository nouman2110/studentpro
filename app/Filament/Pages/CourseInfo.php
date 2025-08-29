<?php

// app/Filament/Pages/CourseInfo.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Course;

class CourseInfo extends Page
{
     public ?Course $course = null;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.course-info';
    protected ?string $heading = '';

    public function mount()
    {
        $courseId = request()->query('record'); 

        if ($courseId) {
            $this->course = Course::findOrFail($courseId);
        }
    }


}
