<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $search = '';

    // Filters
    public $study_level ;
    public $sector ;
    public $broad_field ;
    public $narrow_field ;
    public $detailed_field ;
    public $language ;
    public $course_level ;
    public $state ;
    public array $statesList = [
    'NSW', 'VIC', 'QLD', 'WA', 'SA', 'TAS', 'ACT', 'NT'
];

    public function updating($field)
    {
        // Reset to first page whenever any filter/search is changed
        $this->resetPage();
    }

    // public function render()
    // {
    //     $courses = Course::query()
    //         ->when($this->study_level, fn($q) => $q->where('study_level', $this->study_level))
    //         ->when($this->sector, fn($q) => $q->where('sector', $this->sector))
    //         ->when($this->broad_field, fn($q) => $q->where('broad_field', $this->broad_field))
    //         ->when($this->narrow_field, fn($q) => $q->where('narrow_field', $this->narrow_field))
    //         ->when($this->detailed_field, fn($q) => $q->where('detailed_field', $this->detailed_field))
    //         ->when($this->language, fn($q) => $q->where('language', $this->language))
    //         ->when($this->course_level, fn($q) => $q->where('course_level', $this->course_level))
    //         ->when($this->state, fn($q) =>
    //             $q->whereRaw("TRIM(SUBSTRING_INDEX(course_location, '-', 1)) = ?", [$this->state])
    //         )
    //         ->when($this->search, fn($q) =>
    //             $q->where('name', 'like', "%{$this->search}%")
    //         )
    //         ->orderBy('name')
    //         ->paginate($this->perPage);

    //     $filters = [
    //         'study_levels' => Course::select('study_level')->distinct()->orderBy('study_level')->pluck('study_level'),
    //         'sectors' => Course::select('sector')->distinct()->orderBy('sector')->pluck('sector'),
    //         'broad_fields' => Course::select('broad_field')->distinct()->orderBy('broad_field')->pluck('broad_field'),
    //         'narrow_fields' => Course::select('narrow_field')->distinct()->orderBy('narrow_field')->pluck('narrow_field'),
    //         'detailed_fields' => Course::select('detailed_field')->distinct()->orderBy('detailed_field')->pluck('detailed_field'),
    //         'languages' => Course::select('language')->distinct()->orderBy('language')->pluck('language'),
    //         'course_levels' => Course::select('course_level')->distinct()->orderBy('course_level')->pluck('course_level'),
    //         'states' => $this->statesList,


    //     ];

    //     return view('livewire.course-component', compact('courses', 'filters'));
    // }
    public function render()
{
    $courses = Course::query()
        ->when($this->study_level, fn($q) => $q->where('study_level', $this->study_level))
        ->when($this->sector, fn($q) => $q->where('sector', $this->sector))
        ->when($this->broad_field, fn($q) => $q->where('broad_field', $this->broad_field))
        ->when($this->narrow_field, fn($q) => $q->where('narrow_field', $this->narrow_field))
        ->when($this->detailed_field, fn($q) => $q->where('detailed_field', $this->detailed_field))
        ->when($this->language, fn($q) => $q->where('language', $this->language))
        ->when($this->course_level, fn($q) => $q->where('course_level', $this->course_level))
        ->when($this->state, fn($q) =>
            $q->whereRaw("TRIM(SUBSTRING_INDEX(course_location, '-', 1)) = ?", [$this->state])
        )
        ->when($this->search, fn($q) =>
            $q->where('name', 'like', "%{$this->search}%")
        )
        ->orderBy('name')
        ->paginate($this->perPage);

    // Extract broad code (first 2 digits like "01") from selected broad_field
    $broadPrefix = $this->broad_field ? substr($this->broad_field, 0, 2) : null;

    // Extract narrow code (first 4 digits like "0101") from selected narrow_field
    $narrowPrefix = $this->narrow_field ? substr($this->narrow_field, 0, 4) : null;

    $filters = [
        'study_levels' => Course::select('study_level')->whereNotNull('study_level')->where('study_level', '!=', '')->distinct()->orderBy('study_level')->pluck('study_level'),
        'sectors' => Course::select('sector')->whereNotNull('sector')->where('sector', '!=', '')->distinct()->orderBy('sector')->pluck('sector'),
        'broad_fields' => Course::select('broad_field')->whereNotNull('broad_field')->where('broad_field', '!=', '')->distinct()->orderBy('broad_field')->pluck('broad_field'),
        'narrow_fields' => Course::select('narrow_field')
            ->when($broadPrefix, fn($q) => $q->where('narrow_field', 'like', "$broadPrefix%"))
            ->whereNotNull('narrow_field')
            ->where('narrow_field', '!=', '')
            ->distinct()->orderBy('narrow_field')->pluck('narrow_field'),
        'detailed_fields' => Course::select('detailed_field')
            ->when($narrowPrefix, fn($q) => $q->where('detailed_field', 'like', "$narrowPrefix%"))
            ->whereNotNull('detailed_field')
            ->where('detailed_field', '!=', '')
            ->distinct()->orderBy('detailed_field')->pluck('detailed_field'),
        'languages' => Course::select('language')->whereNotNull('language')->where('language', '!=', '')->distinct()->orderBy('language')->pluck('language'),
        'course_levels' => Course::select('course_level')->whereNotNull('course_level')->where('course_level', '!=', '')->distinct()->orderBy('course_level')->pluck('course_level'),
        'states' => $this->statesList,
    ];

    return view('livewire.course-component', compact('courses', 'filters'));
}

}
