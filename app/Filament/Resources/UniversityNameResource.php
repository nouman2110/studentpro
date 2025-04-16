<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniversityNameResource\Pages;
use App\Filament\Resources\UniversityNameResource\RelationManagers;
use App\Models\UniversityName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UniversityNameResource extends Resource
{
    protected static ?string $model = UniversityName::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Settings';
    // protected static bool $shouldRegisterNavigation = false;
    // protected static ?string $navigationLabel = 'Add Univeristy ';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->autofocus(),
                Forms\Components\TextInput::make('qs_ranking')
                ->autofocus(),
                Forms\Components\TextInput::make('location')
                // ->required()
                ->autofocus(),
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

                Tables\Columns\TextColumn::make('qs_ranking'),
                Tables\Columns\TextColumn::make('location')
                ->getStateUsing(fn($record) => strip_tags($record->location))
                ->tooltip(function ($record) {
                    $text = strip_tags($record->location, '<p><li>');
                    $text = preg_replace('/<\/?(p|li)>/', "\n", $text);
                    $text = preg_replace("/\n+/", "\n", $text);
                    return trim($text);
                })
                ->limit(20),
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
            'index' => Pages\ListUniversityNames::route('/'),
            'create' => Pages\CreateUniversityName::route('/create'),
            'edit' => Pages\EditUniversityName::route('/{record}/edit'),
        ];
    }
}
