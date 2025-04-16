<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\Country;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-asia-australia';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('country_id')
                ->relationship('country', 'name')
                ->required()
                ->options(Country::where('active', 1)->pluck('name', 'id'))
                ->columnSpan('full')
                ->searchable(),
            Forms\Components\TextInput::make('name')
                ->required()
                ->columnSpan('full')
                ->maxValue(100),

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
                Tables\Columns\TextColumn::make('country.name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\IconColumn::make('active')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->slideOver()->modalWidth('md'),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStates::route('/'),
        ];
    }
}
