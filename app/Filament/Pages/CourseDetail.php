<?php

namespace App\Filament\Pages;

use App\Models\Course;
use Filament\Pages\Page;

class CourseDetail extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.course-detail';

    public ?Course $course = null;

    public function mount()
    {
        $courseId = request()->query('record'); 

        if ($courseId) {
            $this->course = Course::with([
                'courseName',
                'studyLevel',
                'school.state',
                'school.university'
            ])->findOrFail($courseId);
        }
    }
}
