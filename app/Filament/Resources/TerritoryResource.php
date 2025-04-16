<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TerritoryResource\Pages;
use App\Filament\Resources\TerritoryResource\RelationManagers;
use App\Models\Country;
use App\Models\Territory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TerritoryResource extends Resource
{
    protected static ?string $model = Territory::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-europe-africa';
    protected static ?string $navigationGroup = 'Settings';

    public static function getFlags()
    {
        $flags = config('flag.flags');
        $data = collect($flags)->mapWithKeys(function ($flag) {
            $url = 'http://studentpro.test/' . $flag['name'];
            return [
                $flag['id'] => '<img src="' . $url . '" alt="flag" style="width: 20px; height: 20px;">',
            ];
        });
    
        return $data;
    }
    
    
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->autofocus()
                ->columnSpan('full'),
                // Select::make('flag')
                // ->label('Select Flag')
                // ->options(self::getFlags())
                // ->allowHtml() // Allow HTML in the options
                // ->required() // Make this field required if needed
                // ->columnSpan('full'),
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
                    ImageColumn::make('flag')
                    ->label('Flag')
                    ->url(fn ($record) => $record->flag),
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
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->slideOver()->modalWidth('md'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTerritories::route('/'),
        ];
    }
}
