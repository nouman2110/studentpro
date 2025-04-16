<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseNameResource\Pages;
use App\Filament\Resources\CourseNameResource\RelationManagers;
use App\Models\CourseName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseNameResource extends Resource
{
    protected static ?string $model = CourseName::class;

    protected static ?string $navigationIcon = 'heroicon-o-command-line';
    protected static ?string $navigationGroup = 'Courses';
    protected static ?string $navigationLabel = 'Main Course Title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->autofocus()
                ->columnSpan('full'),
              
            Forms\Components\Toggle::make('active')
                ->label('Active')
                ->default(true),
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

                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
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
            'index' => Pages\ListCourseNames::route('/'),
            'create' => Pages\CreateCourseName::route('/create'),
            'edit' => Pages\EditCourseName::route('/{record}/edit'),
        ];
    }
}
