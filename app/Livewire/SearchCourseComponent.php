<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; 
use App\Models\Course;
use App\Models\CourseName;
use App\Models\School;
use App\Models\StudyLevel;

class SearchCourseComponent extends Component
{
    use WithPagination;

    public $states = [];
    public $universities = [];
    public $schools = [];
    public $studyLevels = [];
    public $courseNames = [];
    public $categories = [];
    public $state;
    public $university;
    public $school;
    public $studyLevel;
    public $courseName;
    public $category;
    public $searchCourseName = '';

    protected $queryString = [
        'state', 'university', 'school', 'studyLevel', 'courseName', 'category',
    ];

    public function updating($property)
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->states = School::with('state')
            ->distinct()
            ->get()
            ->map(function ($school) {
                return [
                    'state_id' => $school->state_id,
                    'state_name' => $school->state->name ?? 'N/A',
                ];
            })
            ->unique('state_id');

        $this->categories = CourseName::select('id', 'name')->distinct()->get();
        $this->universities = School::distinct()->pluck('university_name_id')->toArray();
        $this->schools = School::with('university')->get();
        $this->studyLevels = StudyLevel::all();
        $this->courseNames = Course::distinct()->pluck('name')->toArray();
    }

    public function getCoursesProperty()
    {
        return Course::query()
            ->when($this->state, fn($query) => $query->whereHas('school', fn($q) => $q->where('state_id', $this->state)))
            ->when($this->university, fn($query) => $query->whereHas('school', fn($q) => $q->where('university_name_id', $this->university)))
            ->when($this->school, fn($query) => $query->where('school_id', $this->school))
            ->when($this->studyLevel, fn($query) => $query->where('study_level_id', $this->studyLevel))
            ->when($this->courseName, fn($query) => $query->where('name', $this->courseName))
            ->when($this->searchCourseName, fn($query) => $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchCourseName . '%')
                  ->orWhereHas('school', function($q) {
                      $q->whereHas('university', function($q) {
                          $q->where('name', 'like', '%' . $this->searchCourseName . '%');
                      });
                  });
            }))
            ->when($this->category, fn($query) => $query->where('course_name_id', $this->category))
            ->with(['school', 'studyLevel']) 
            ->paginate(10); 
    }
    

    public function render()
    {
        return view('livewire.search-course-component', [
            'courses' => $this->courses,
        ]);
    }
}
