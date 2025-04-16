<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniversityResource\Pages;
use App\Filament\Resources\UniversityResource\RelationManagers;
use App\Models\Country;
use App\Models\Group;
use App\Models\Sector;
use App\Models\State;
use App\Models\StudyLevel;
use App\Models\Territory;
use App\Models\University;
use App\Models\UniversityName;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Contracts\View\View;

class UniversityResource extends Resource
{
    protected static ?string $model = University::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'Add Commissions';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('University')
                ->schema([
                    // Forms\Components\TextInput::make('name')
                    //     ->label('University Name')
                    //     ->required()
                    //     ->maxValue(100),
                    Forms\Components\Select::make('university_name_id')
                        ->label('University')
                        ->relationship('university', 'name')
                        ->options(UniversityName::pluck('name', 'id'))
                        ->searchable(),    

                    Forms\Components\Select::make('country_id')
                        ->label('Country')
                        ->relationship('country', 'name')
                        ->required()
                        ->options(Country::where('active', 1)->pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('state_id')
                        ->label('State')
                        ->relationship('state', 'name')
                        ->options(State::where('active', 1)->pluck('name', 'id'))
                        ->searchable(),

                    

                    Forms\Components\Select::make('group_id')
                        ->label('Group')
                        ->relationship('group', 'name')
                        ->options(Group::where('active', 1)->pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('sector_id')
                        ->label('Sector')
                        ->relationship('sector', 'name')
                        ->options(Sector::where('active', 1)->pluck('name', 'id'))
                        ->searchable(),

                    Forms\Components\Select::make('scholarship')
                        ->label('Scholarship')
                        ->required()
                        ->options([
                            'yes' => 'Yes',
                            'no' => 'No',
                        ])
                        ->default('no'),

                    Forms\Components\Select::make('promotion')
                        ->label('Promotion')
                        ->required()
                        
                        ->options([
                            'yes' => 'Yes',
                            'no' => 'No',
                        ])
                        ->default('no'),

                        Forms\Components\Select::make('territory_id')
                        ->label('Territory')
                        ->relationship('territories', 'name')
                        ->multiple()
                        ->columnSpan(2)
                        ->options(Territory::where('active', 1)->pluck('name', 'id'))
                        ->searchable(),
                ])
                ->collapsible()
                ->compact()
                ->columns(3),

            Forms\Components\Section::make('Commission')
                ->schema([
                    TableRepeater::make('commissions')
                        ->relationship('commissions')
                        ->label('')
                        ->schema([

                        Forms\Components\Select::make('study_level_id')
                            ->label('Study Level')
                            // ->relationship('studyLevels', 'name')
                            ->required()
                            ->options(StudyLevel::where('active', 1)->pluck('name', 'id'))
                            ->searchable(),

                        Forms\Components\TextInput::make('scholarship_amount')
                            ->label('Scholarship Amount'),

                        Forms\Components\TextInput::make('commission_percent')
                            ->label('Commission (%)')
                            ->numeric()
                            ->required()
                            ->maxValue(100)
                            ->minValue(0),
                        ])
                        ->colStyles([
                            'study_level_id' => 'width: 250px;',
                        ])
                        ->addActionLabel('Add More Levels')
                        ->collapsible()
                        ->columnSpan('full'),
                ])
                ->collapsible()
                ->compact(), 
            
                Forms\Components\Section::make('English Requirements')
                ->schema([
                    TableRepeater::make('englishRequirements')
                        ->relationship('englishRequirements')
                        ->label('')
                        ->schema([
                            Forms\Components\Select::make('study_level_id')
                            ->label('Study Level')
                            // ->relationship('studyLevels', 'name')
                            ->required()
                            ->options(StudyLevel::where('active', 1)->pluck('name', 'id'))
                            ->searchable(),
                            Forms\Components\TextInput::make('test_name')
                            ->label('Test Name')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('minimum_score')
                            ->label('Minimum Score')
                            ->required(),
                        Forms\Components\TextInput::make('validity_period')
                            ->label('Validity Period')
                            ->numeric()
                            ->required()
                            ->maxValue(10)
                            ->minValue(0),
                        ])
                        ->colStyles([
                            'study_level_id' => 'width: 250px;',
                        ])
                        ->addActionLabel('Add More Tests')
                        ->collapsible()
                        ->columnSpan('full'),
                ])
                ->collapsible()
                ->compact(),     
        ]);
        
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('university.name')
                ->label('University Name')
                ->sortable()
                ->searchable()
                ->action(
                    Action::make('advance')
                    ->label('Advance')
                    ->action(fn (University $record) => $record->advance())
                    ->modalContent(fn (University $record): View => view(
                        'filament.pages.commissions', 
                        ['record' => $record]       
                    ))
                    ->modalHeading('Couses & Commssion Details')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->slideOver()
                    ->modalWidth(MaxWidth::TwoExtraLarge)
                ),
        
            Tables\Columns\TextColumn::make('country.name')
                ->label('Country')
                ->sortable()
                ->searchable(),
        
            Tables\Columns\TextColumn::make('state.name')
                ->label('State')
                ->sortable()
                ->searchable(),

            TextColumn::make('territories.name')
                ->label('Territories .')
                ->formatStateUsing(function ($record) {
                    return "<div style='display: flex; flex-wrap: wrap; gap: 5px;'>"
                        . $record->territories->map(function ($territory) {
                            return "<img src='{$territory->flag}' alt='Flag' title='{$territory->name}' width='15' height='10' >";
                        })->implode(' ')
                        . "</div>";
                })
                ->html(),
            // Tables\Columns\TextColumn::make('englishRequirements.test_name')
            //     ->label('Test Name')
            //     ->formatStateUsing(function ($record) {
            //         if (!$record->englishRequirements || $record->englishRequirements->isEmpty()) {
            //             return '-';
            //         }

            //         return "<div style='display: flex; flex-direction: column; gap: 5px;'>"
            //             . $record->englishRequirements->map(function ($requirement) {
            //                 return "<span>{$requirement->test_name}</span>";
            //             })->implode('') 
            //             . "</div>";
            //     })
            //     ->html()
            //     ->sortable()
            //     ->searchable(),
             
            // Tables\Columns\TextColumn::make('englishRequirements.minimum_score')
            //     ->label('Minimum Score')
            //     ->formatStateUsing(function ($record) {
            //         if (!$record->englishRequirements || $record->englishRequirements->isEmpty()) {
            //             return '-';
            //         }

            //         return "<div style='display: flex; flex-direction: column; gap: 5px;'>"
            //             . $record->englishRequirements->map(function ($requirement) {
            //                 return "<span>{$requirement->minimum_score}</span>";
            //             })->implode('') 
            //             . "</div>";
            //     })
            //     ->html()
            //     ->sortable()
            //     ->searchable(), 
              
            // Tables\Columns\TextColumn::make('englishRequirements.validity_period')
            //     ->label('Validity')
            //     ->formatStateUsing(function ($record) {
            //         if (!$record->englishRequirements || $record->englishRequirements->isEmpty()) {
            //             return '-';
            //         }

            //         return "<div style='display: flex; flex-direction: column; gap: 5px;'>"
            //             . $record->englishRequirements->map(function ($requirement) {
            //                 return "<span>{$requirement->validity_period}</span>";
            //             })->implode('') 
            //             . "</div>";
            //     })
            //     ->html()
            //     ->sortable()
            //     ->searchable(),
                   

            // Tables\Columns\TextColumn::make('group.name')
            //     ->label('Group')
            //     ->sortable()
            //     ->searchable(),
        
            Tables\Columns\TextColumn::make('sector.name')
                ->label('Sector')
                ->sortable()
                ->searchable(),
        
            // Scholarship column showing "Yes" or "No"
            Tables\Columns\BadgeColumn::make('scholarship')
            // ->color('success')
                ->label('Scholarship')
                ->formatStateUsing(fn ($state) => $state === 'yes' ? 'Scholarship' : null)
                ->sortable(),
           
        ])        
            ->filters([
                SelectFilter::make('country_id')->relationship('country', 'name')
                    ->multiple()
                    ->label('Country Name')
                    ->preload(),
                SelectFilter::make('state_id')
                ->relationship('state', 'name')
                ->multiple()
                ->label('State Name')
                ->preload(),
                SelectFilter::make('territories')
                ->relationship('territories', 'name')
                ->multiple()
                ->label('Territory Name')
                ->preload(),
            SelectFilter::make('group_id')
                ->relationship('group', 'name')
                ->multiple()
                ->label('Group Name')
                ->preload(),

            SelectFilter::make('sector_id')
                ->relationship('sector', 'name')
                ->multiple()
                ->label('Sector Name')
                ->preload(),

            SelectFilter::make('scholarship')
                ->options([
                    'yes' => 'Yes',
                    'no' => 'No',
                ])
                ->label('Scholarship'),

            SelectFilter::make('promotion')
                ->options([
                    'yes' => 'Yes',
                    'no' => 'No',
                ])
                ->label('Promotion'),
            ])
            ->filtersFormColumns(2)
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\Action::make('englishRequirement')
                    ->label('')
                    ->icon('heroicon-o-newspaper')
                    ->tooltip('English Requirement')
                    ->action(fn (University $record) => $record->advance()) // Optional backend action
                    ->modalContent(fn (University $record): View => view(
                        'filament.pages.english-requirements', 
                        ['record' => $record]
                    ))
                    ->modalHeading('English Requirement')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->slideOver(),
                Tables\Actions\Action::make('commssion')
                    ->label('')
                    ->icon('heroicon-o-currency-dollar')
                    ->tooltip('Commsions')
                    ->action(fn (University $record) => $record->advance()) // Optional backend action
                    ->modalContent(fn (University $record): View => view(
                        'filament.pages.commissions', 
                        ['record' => $record]
                    ))
                    ->modalHeading('Commsions')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->slideOver()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUniversities::route('/'),
            'create' => Pages\CreateUniversity::route('/create'),
            'edit' => Pages\EditUniversity::route('/{record}/edit'),
        ];
    }
}
