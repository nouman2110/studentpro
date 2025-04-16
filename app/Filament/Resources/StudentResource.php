<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Group::make()

                ->schema([
                    Forms\Components\Section::make('Personal Information')
                        ->schema([
                            
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('email')->unique(ignoreRecord: true)
                                ->required(),
                            Forms\Components\TextInput::make('phone')->required(),
                            // PhoneInput::make('phone')->inputNumberFormat(PhoneInputNumberType::NATIONAL),
                            Forms\Components\TextInput::make('city'),
                            Forms\Components\TextInput::make('cnic')->label('CNIC'),
                            Forms\Components\DatePicker::make('dob')->native(false)->label('DOB'),
                           
                        ])
                        ->collapsible()
                        ->compact()
                        ->columns(2),
                    Forms\Components\Section::make('Upload Personal Documents')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('matric')
                            ->collection('matric-result-card')
                            ->disableLabel()
                            ->openable()
                            ->multiple()
                            ->downloadable()
                            ->placeholder('Matric Result Card Pdf Format')
                            ->acceptedFileTypes(['application/pdf']),
                        SpatieMediaLibraryFileUpload::make('intermediate')
                            ->collection('intermediate-result-card')
                            ->disableLabel()
                            ->openable()
                            ->multiple()
                            ->downloadable()
                            ->placeholder('Intermediate Result Card Pdf Format')
                            ->acceptedFileTypes(['application/pdf']),
                        SpatieMediaLibraryFileUpload::make('bachelor')
                            ->collection('bachelor-result-card')
                            ->disableLabel()
                            ->downloadable()
                            ->openable()
                            ->placeholder('Bachelor Result Card Pdf Format')
                            ->multiple()
                            ->acceptedFileTypes(['application/pdf']),
                        SpatieMediaLibraryFileUpload::make('passport')
                            ->collection('passport')
                            ->disableLabel()
                            ->downloadable()
                            ->multiple()
                            ->acceptedFileTypes(['application/pdf'])
                            ->placeholder('Passport Pdf Format'),
                        SpatieMediaLibraryFileUpload::make('reference')
                            ->collection('reference-letter')
                            ->multiple()
                            ->disableLabel()
                            ->openable()
                            ->multiple()
                            ->downloadable()
                            ->placeholder('Reference Letter Pdf Format')
                            ->acceptedFileTypes(['application/pdf']),
                        // ->image(),
                        SpatieMediaLibraryFileUpload::make('sop')
                            ->collection('sop')
                            ->disableLabel()
                            ->multiple()
                            ->disabled()
                            ->openable()
                            ->multiple()
                            ->downloadable()
                            ->placeholder('SOP'),
                        SpatieMediaLibraryFileUpload::make('cv')
                            ->collection('cv')
                            ->disableLabel()
                            ->openable()
                            ->multiple()
                            ->downloadable()
                            ->placeholder('Upload CV Pdf Format')
                            ->acceptedFileTypes(['application/pdf']),
                        SpatieMediaLibraryFileUpload::make('optionaldocument')
                            ->collection('optional-documents')
                            ->disableLabel()
                            ->openable()
                            ->downloadable()
                            ->multiple()
                            ->placeholder('Optional Document'),
                            SpatieMediaLibraryFileUpload::make('proficiency')
                            ->collection('proficiency-test')
                            ->disableLabel()
                            ->openable()
                            ->downloadable()
                            ->multiple()
                            ->placeholder('English Proficiency Test Document'),
                    ])
                    ->collapsible()
                    ->compact()
                    ->columns(2),

                ])
                ->columnSpan(['lg' => 2]),
            Forms\Components\Group::make()
                ->schema([
                   
                    Forms\Components\Section::make('Profile Picture')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('media')
                                ->collection('profile-images')
                                ->disableLabel()
                                ->downloadable()
                                ->image(),
                        ])
                        ->compact()
                        ->collapsible(),
                   
                       
    


                ])
                ->columnSpan(['lg' => 1]),  
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100])
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('name')->searchable()->label('Student Name'),
                TextColumn::make('city')->searchable(),
                TextColumn::make('phone')->searchable()->copyable(),
                TextColumn::make('email')->searchable()
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }
                        return $state;
                    })
                    ->copyable(),
                TextColumn::make('user.name')->searchable()->label('Created By'),    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
