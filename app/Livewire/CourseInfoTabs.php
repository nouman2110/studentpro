<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseInfoTabs extends Component
{
    public Course $course;
    public string $activeTab = 'course';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.course-info-tabs');
    }
}
