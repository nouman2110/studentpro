<?php

namespace App\Imports;

use App\Models\{
    Course, State, Sector, BroadField, NarrowField, DetailedField,
    StudyLevel, Institution, Provider
};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoursesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $courseName = trim($row['course_name']);
            $courseLocation = $row['course_location'];

            if (empty($courseName) || Course::where('name', $courseName)->exists()) {
                continue; // Skip if name is empty or duplicate
            }

            // Extract state from course_location
            $stateName = trim(explode('-', $courseLocation)[0]);
            $state = State::firstOrCreate(['name' => $stateName]);

            // Lookup or create related models
            $sector = Sector::firstOrCreate(['name' => $row['course_sector']]);
            $broad = BroadField::firstOrCreate(['name' => $row['broad_field']]);
            $narrow = NarrowField::firstOrCreate([
                'name' => $row['narrow_field'],
                'broad_field_id' => $broad->id,
            ]);
            $detailed = DetailedField::firstOrCreate([
                'name' => $row['detailed_field'],
                'narrow_field_id' => $narrow->id,
            ]);
            $studyLevel = StudyLevel::firstOrCreate(['name' => $row['level']]);
            $provider = Provider::firstOrCreate([
                'name' => $row['provider']
            ], [
                'cricos_code' => $row['cricos_provider_code']
            ]);

            $institution = Institution::firstOrCreate([
                'name' => $row['institution_name'],
            ], [
                'trading_name' => $row['institution_trading_name'],
                'type' => $row['institution_type'],
                'total_capacity' => $row['total_capacity'],
                'website' => $row['website'],
                'postal_address' => $row['institution_postal_address'],
                'student_contact_name' => $row['student_contact_name'],
                'student_contact_title' => $row['student_contact_title'],
                'student_contact_phone' => $row['student_contact_phone'],
                'student_contact_fax' => $row['student_contact_fax'],
                'student_contact_email' => $row['student_contact_email'],
                'head_name' => $row['head_name'],
                'head_title' => $row['head_title'],
                'head_phone' => $row['head_phone'],
                'head_fax' => $row['head_fax'],
                'head_email' => $row['head_email'],
            ]);

            // Create the course record
            Course::create([
                'name' => $courseName,
                'provider_id' => $provider->id,
                'study_level_id' => $studyLevel->id,
                'duration' => $row['duration'],
                'sector_id' => $sector->id,
                'cricos_course_code' => $row['cricos_course_code'],
                'dual_qualification' => $row['dual_qualification'],
                'broad_field_id' => $broad->id,
                'narrow_field_id' => $narrow->id,
                'detailed_field_id' => $detailed->id,
                'course_level' => $row['course_level'],
                'foundation_study' => strtolower($row['foundation_studies']) === 'yes',
                'work_component' => strtolower($row['work_component']) === 'yes',
                'language' => $row['course_language'],
                'duration_weeks' => $row['duration_weeks'],
                'tuition_fee' => $row['tuition_fee'],
                'non_tuition_fee' => $row['non_tuition_fee'],
                'estimated_total_cost' => $row['estimated_total_course_cost'],
                'course_location' => $courseLocation,
                'state_id' => $state->id,
                'cricos_provider_code' => $row['cricos_provider_code'],
                'institution_id' => $institution->id,
            ]);
        }
    }
}
