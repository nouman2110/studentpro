<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddCourseResource\Pages;
use App\Filament\Resources\AddCourseResource\RelationManagers;
use App\Models\AddCourse;
use App\Models\Course;
use App\Models\CourseName;
use App\Models\StudyLevel;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddCourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Courses';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('school_id')
                ->default(request()->get('school_id'))
                ->required(),
                Forms\Components\Select::make('study_level_id')
                ->options(StudyLevel::where('active', 1)->pluck('name', 'id')->toArray())
                ->placeholder('Select Study Level')
                ->label('Study Level'),
                Forms\Components\Select::make('course_name_id')
                    ->label('Course Name')
                    ->relationship('courseName', 'name')
                    ->options(CourseName::pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->placeholder('Enter Course Full Name')
                    ->label('Full COurse Name'),    
            
            Forms\Components\TextInput::make('annual_fee')
                ->placeholder('Enter Annual Fee')
                ->label('Annual Fee'),
            
            Forms\Components\TextInput::make('duration')
                ->placeholder('Enter Course Duration')
                ->label('Duration'),
            
            Forms\Components\TextInput::make('study_mode')
                ->placeholder('Enter Study Mode (e.g., Online, On-Campus)')
                ->label('Study Mode'),
            
            Forms\Components\TextInput::make('start_date')
                ->placeholder('Select Sart Date')
                ->label('Start Date'),
            
                Forms\Components\Select::make('accreditation')
                ->label('Accreditation')
                ->options([
                    0 => 'No',
                    1 => 'Yes',
                ])
                ->placeholder('Select Accreditation')
                ->default(0), // Default to 'No' (0)
            
            Forms\Components\Select::make('regional_area')
                ->label('Regional Area')
                ->options([
                    0 => 'No',
                    1 => 'Yes',
                ])
                ->placeholder('Select Regional Area')
                ->default(0), // Default to 'No' (0)
            
            Forms\Components\Select::make('country_requirement')
                ->label('Country Requirement')
                ->options([
                    0 => 'No',
                    1 => 'Yes',
                ])
                ->placeholder('Select Country Requirement')
                ->default(0), // Default to 'No' (0)
            
            Forms\Components\Select::make('regional_requirement')
                ->label('Regional Requirement')
                ->options([
                    0 => 'No',
                    1 => 'Yes',
                ])
                ->placeholder('Select Regional Requirement')
                ->default(0), // Default to 'No' (0)
            
            
            Forms\Components\TextInput::make('pathway_to_visa')
                ->placeholder('Enter Visa Pathway Details')
                ->label('Pathway to Visa'),
            
            Forms\Components\RichEditor::make('admmision_req')
                ->placeholder('Enter Admission Requirements')
                ->label('Admission Requirements')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100])
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('annual_fee')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddCourses::route('/'),
            // 'create' => Pages\CreateAddCourse::route('/create'),
            'edit' => Pages\EditAddCourse::route('/{record}/edit'),
        ];
    }
}
