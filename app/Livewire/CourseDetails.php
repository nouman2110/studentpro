<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseDetails extends Component
{
    public $course;

    public function mount($courseId)
    {
        $this->course = Course::with(['courseName', 'studyLevel', 'school.state', 'school.university'])
                              ->findOrFail($courseId);
    }
    public function render()
    {
        return view('livewire.course-details');
    }
}
