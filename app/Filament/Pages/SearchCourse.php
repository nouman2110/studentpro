<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SearchCourse extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?string $navigationGroup = 'Courses';
    protected static string $view = 'filament.pages.search-course';
}
