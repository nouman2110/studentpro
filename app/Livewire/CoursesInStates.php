<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\School;

class CoursesInStates extends Component
{
    public $schools = [];

    // Listen for the 'stateSelected' event
    #[On('course')]
    public function handleCourseEvent($course, $state)
    {
        // When the event is received, handle the $stateId
        dd($course, $state); // For testing, this will dump the stateId received
    }

    public function render()
    {
        return view('livewire.courses-in-states', [
            'schools' => $this->schools,
        ]);
    }
}
