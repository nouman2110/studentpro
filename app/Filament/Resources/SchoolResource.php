<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\CourseName;
use App\Models\School;
use App\Models\State;
use App\Models\StudyLevel;
use App\Models\UniversityName;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationGroup = 'Courses';
    protected static ?string $navigationLabel = 'Add Courses';
    public static function getPluralLabel(): ?string
    {
            return 'University' ;

    }
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('University')
                ->schema([
                    Forms\Components\Select::make('state_id')
                        ->label('State')
                        ->relationship('state', 'name')
                        ->options(State::where('active', 1)->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\Select::make('university_name_id')
                        ->label('University')
                        ->relationship('university', 'name')
                        ->options(UniversityName::pluck('name', 'id'))
                        ->searchable()
                        ->live()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->autofocus(),
                            Forms\Components\TextInput::make('qs_ranking')
                                ->autofocus(),
                            Forms\Components\TextInput::make('location')
                            // ->required()
                                ->autofocus(),
                        ]) 
                        ->afterStateUpdated(function ($state, $set) {
                            $universityId = $state;
                            if ($universityId) {
                                $university = UniversityName::find($universityId);
                                $set('location', $university->location ?? ''); 
                                $set('qs_ranking', $university->qs_ranking ?? '');
                            } else {
                                $set('location', null);
                                $set('qs_ranking', null);
                            }
                        }),
                    
                    Forms\Components\Select::make('qs_ranking')
                        ->label('University Ranking')
                        ->disabled()
                        ->options(function ($get) {
                            $universityId = $get('university_name_id');
                            
                            if ($universityId) {
                                $university = UniversityName::find($universityId);
                                return [
                                    $university->qs_ranking => $university->qs_ranking ?? 'Not Available',
                                ]; 
                            }
                            return []; 
                        })
                        ->visible(function ($get) {
                            return $get('university_name_id') !== null;
                        }),
                    
                    Forms\Components\Select::make('location')
                        ->label('University Location')
                        ->disabled()
                        ->options(function ($get) {
                            $universityId = $get('university_name_id');
                            
                            if ($universityId) {
                                $university = UniversityName::find($universityId);
                                return [
                                    $university->location => $university->location ?? 'Location not available',
                                ]; 
                            }
                    
                            return []; 
                        })
                        ->visible(function ($get) {
                            return $get('university_name_id') !== null;
                        })
                        ->columnSpanFull(),
                  
                ])
                ->collapsible()
                ->compact()
                ->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100])
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('state.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('university.name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('')
                ->tooltip('Edit'),
                // Tables\Actions\Action::make('addCourse')
                // ->label('Add Course')
                // ->icon('heroicon-o-plus')
                // ->url(fn (School $record) => route('filament.admin.resources.add-courses.create', ['school_id' => $record->id])),
                Tables\Actions\Action::make('Add Course')
                    ->icon('heroicon-m-academic-cap')
                    ->label('')
                    ->tooltip('Add Course')
                    ->form([
                        Grid::make(2)->schema([
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
                Tables\Actions\Action::make('courses')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View Added Courses')
                    ->action(fn (School $record) => $record->advance()) 
                    ->modalContent(fn (School $record): View => view(
                        'filament.pages.courses', 
                        ['record' => $record]
                    ))
                    ->modalHeading('Added Courses')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->slideOver()
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
