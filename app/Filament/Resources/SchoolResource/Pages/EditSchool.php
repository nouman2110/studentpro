<?php

namespace App\Filament\Resources\SchoolResource\Pages;

use App\Filament\Resources\SchoolResource;
use App\Imports\CourseImport;
use App\Models\CourseName;
use App\Models\School;
use App\Models\StudyLevel;
use App\Models\UniversityName;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\RichEditor;

class EditSchool extends EditRecord
{
    protected static string $resource = SchoolResource::class;

    protected function getHeaderActions(): array
    {
        $schoolId = $this->record->id ? $this->record->id : null;

        CourseImport::setSchoolId($schoolId);
        return [
                \EightyNine\ExcelImport\ExcelImportAction::make()
                ->icon('heroicon-o-newspaper')
                ->label('Import Excel')
                ->sampleExcel(
                    sampleData: [
                        ['study_level_id' => 1, 'course_name_id' => 1, 'name' => 'Course 1', 'annual_fee' => 1000, 'duration' => '1 Year', 'study_mode' => 'Online', 'start_date' => '2025-01-01', 'accreditation' => 1, 'regional_area' => 1, 'country_requirement' => 1, 'regional_requirement' => 1, 'pathway_to_visa' => 'Details', 'admmision_req' => 'Details'],
                        ['study_level_id' => 2, 'course_name_id' => 2, 'name' => 'Course 2', 'annual_fee' => 2000, 'duration' => '2 Years', 'study_mode' => 'On-Campus', 'start_date' => '2025-02-01', 'accreditation' => 1, 'regional_area' => 0, 'country_requirement' => 1, 'regional_requirement' => 0, 'pathway_to_visa' => 'Details', 'admmision_req' => 'Details'],
                    ],
                    fileName: 'course_sample.xlsx',
                    customiseActionUsing: fn(Action $action) => $action->color('primary')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation(),
                )
                    ->color("primary")
                ->use(CourseImport::class),

            Actions\Action::make('Add Course')
            ->icon('heroicon-o-academic-cap')
            ->label('Add Course')
            ->tooltip('Add Course')
            ->form([
                Grid::make(2)->schema([
                    Select::make('study_level_id')
                    ->options(StudyLevel::where('active', 1)->pluck('name', 'id')->toArray())
                    ->placeholder('Select Study Level')
                    ->label('Study Level'),
                    Select::make('course_name_id')
                        ->label('Course Name')
                        ->relationship('courseName', 'name')
                        ->options(CourseName::pluck('name', 'id'))
                        ->searchable()
                        ->required(),
    
                    TextInput::make('name')
                        ->placeholder('Enter Course Full Name')
                        ->label('Full COurse Name'),    
                
                    TextInput::make('annual_fee')
                            ->placeholder('Enter Annual Fee')
                            ->label('Annual Fee'),
                        
                    TextInput::make('duration')
                            ->placeholder('Enter Course Duration')
                            ->label('Duration'),
                        
                    TextInput::make('study_mode')
                            ->placeholder('Enter Study Mode (e.g., Online, On-Campus)')
                            ->label('Study Mode'),
                        
                    TextInput::make('start_date')
                            ->placeholder('Select Sart Date')
                            ->label('Start Date'),
                
                   Select::make('accreditation')
                    ->label('Accreditation')
                    ->options([
                        0 => 'No',
                        1 => 'Yes',
                    ])
                    ->placeholder('Select Accreditation')
                    ->default(0), // Default to 'No' (0)
                
                    Select::make('regional_area')
                            ->label('Regional Area')
                            ->options([
                                0 => 'No',
                                1 => 'Yes',
                            ])
                            ->placeholder('Select Regional Area')
                            ->default(0), // Default to 'No' (0)
                        
                    Select::make('country_requirement')
                            ->label('Country Requirement')
                            ->options([
                                0 => 'No',
                                1 => 'Yes',
                            ])
                            ->placeholder('Select Country Requirement')
                            ->default(0), // Default to 'No' (0)
                        
                    Select::make('regional_requirement')
                            ->label('Regional Requirement')
                            ->options([
                                0 => 'No',
                                1 => 'Yes',
                            ])
                            ->placeholder('Select Regional Requirement')
                            ->default(0), // Default to 'No' (0)
                        
                        
                    TextInput::make('pathway_to_visa')
                            ->placeholder('Enter Visa Pathway Details')
                            ->label('Pathway to Visa'),
                        
                    RichEditor::make('admmision_req')
                            ->placeholder('Enter Admission Requirements')
                            ->label('Admission Requirements')->columnSpanFull(),
                ]),
            ])
            ->action(function (array $data, School $record): void {
                $record->courses()->create([
                    'school_id' => $record->id,
                    'study_level_id' => $data['study_level_id'],
                    'course_name_id' => $data['course_name_id'],
                    'name' => $data['name'],
                    'annual_fee' => $data['annual_fee'],
                    'duration' => $data['duration'],
                    'study_mode' => $data['study_mode'],
                    'start_date' => $data['start_date'],
                    'accreditation' => $data['accreditation'],
                    'regional_area' => $data['regional_area'],
                    'country_requirement' => $data['country_requirement'],
                    'regional_requirement' => $data['regional_requirement'],
                    'pathway_to_visa' => $data['pathway_to_visa'],
                    'admmision_req' => $data['admmision_req'],
                ]);
        
                // Display a success message
                Notification::make()
                    ->title('Course Added Successfully')
                    ->success()
                    ->send();
            })
            ->modalSubmitActionLabel('Save'),
            Actions\DeleteAction::make(),
        ];
    }
    public function mutateFormDataBeforeFill(array $data): array
    {
        $universityId = $data['university_name_id'] ?? null;
        if ($universityId) {

            $university = UniversityName::find($universityId);
            $data['location'] = $university->location ?? 'Location not available';
            $data['qs_ranking'] = $university->qs_ranking ?? 'Ranking not available';
        } else {
            $data['location'] = null;
            $data['qs_ranking'] = null;
        }

        return $data;
    }

}
