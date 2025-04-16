<?php

namespace App\Filament\Resources\UniversityNameResource\Pages;

use App\Filament\Resources\UniversityNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUniversityNames extends ListRecords
{
    protected static string $resource = UniversityNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
