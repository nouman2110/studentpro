<?php

namespace App\Filament\Resources\AddCourseResource\Pages;

use App\Filament\Resources\AddCourseResource;
use App\Models\Course;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAddCourse extends CreateRecord
{
    protected static string $resource = AddCourseResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['school_id'] = $data['school_id'] ?? request()->get('school_id');
    
        return $data;
    }
    
}
