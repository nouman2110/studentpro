<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getFilteredRoles()
    {
        return Role::all()->pluck('name', 'id');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->schema([
                        TextInput::make('name')->required(),
    
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        // Forms\Components\TextInput::make('password')
                        //     ->password()
                        //     ->hidden()
                        //     ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        //     ->dehydrated(fn (?string $state): bool => filled($state))
                        //     ->required(fn (string $operation): bool => $operation === 'create'),    
    
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->options(self::getFilteredRoles())
                            ->default(1)
                            ->required()
                            ->live(),
                    ])->columns(3),
    
                Section::make('Agent Details')
                    ->visible(fn (Get $get) => Role::find($get('roles'))?->name === 'Agent')
                    ->schema([
                        TextInput::make('legal_name')
                            ->label('Legal Name')
                            ->required(fn (Get $get) => Role::find($get('roles'))?->name === 'Agent'),
    
                        TextInput::make('trading_name')
                            ->label('Trading Name')
                            ->required(fn (Get $get) => Role::find($get('roles'))?->name === 'Agent'),
    
                        TextInput::make('abn_reg_no')
                            ->label('ABN Registration No')
                            ->required(fn (Get $get) => Role::find($get('roles'))?->name === 'Agent'),
    
                        TextInput::make('address')
                            ->label('Address')
                            ->required(fn (Get $get) => Role::find($get('roles'))?->name === 'Agent'),
    
                        TextInput::make('phone')
                            ->label('Phone')
                            ->required(fn (Get $get) => Role::find($get('roles'))?->name === 'Agent'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('roles.name')
                ->badge()
                ->color(fn (string $state): string => match ($state) {

                    'Super Admin' => 'warning',
                    'Agent' => 'success',
                })
                ->sortable()
                ->label('Role')
                ->toggleable(),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable()->toggleable(),
            Tables\Columns\TextColumn::make('email')->searchable()->sortable()->toggleable()->copyable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
