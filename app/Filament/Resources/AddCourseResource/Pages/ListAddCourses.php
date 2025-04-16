<?php

namespace App\Filament\Resources\AddCourseResource\Pages;

use App\Filament\Resources\AddCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAddCourses extends ListRecords
{
    protected static string $resource = AddCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
