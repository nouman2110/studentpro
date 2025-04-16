<?php

namespace App\Filament\Resources\AddCourseResource\Pages;

use App\Filament\Resources\AddCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAddCourse extends EditRecord
{
    protected static string $resource = AddCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['school_id'] = $data['school_id'] ?? request()->get('school_id');
    
        return $data;
    }
}
