<?php

namespace App\Imports;

use App\Models\Course;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;

class CourseImport implements ToModel, WithHeadingRow, WithEvents
{
    public static $schoolId;

    public static function setSchoolId($schoolId)
    {
        self::$schoolId = $schoolId;
    }

    public function model(array $row)
    {
        return new Course([
            'school_id' => self::$schoolId,  
            'study_level_id' => $row['study_level_id'],
            'course_name_id' => $row['course_name_id'],
            'name' => $row['name'],
            'annual_fee' => $row['annual_fee'],
            'duration' => $row['duration'],
            'study_mode' => $row['study_mode'],
            'start_date' => $row['start_date'],
            'accreditation' => $row['accreditation'],
            'regional_area' => $row['regional_area'],
            'country_requirement' => $row['country_requirement'],
            'regional_requirement' => $row['regional_requirement'],
            'pathway_to_visa' => $row['pathway_to_visa'],
            'admmision_req' => $row['admmision_req'],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) { 
                Notification::make()
                    ->title('Import Successful')
                    ->body('The courses have been successfully imported to database.')
                    ->success()
                    ->send();
            },
        ];
    }
}
