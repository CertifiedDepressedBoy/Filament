<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\EmployeeResource\Pages;
use App\Filament\App\Resources\EmployeeResource\RelationManagers;
use Filament\Facades\Filament;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Name')
                ->description('Please enter the user name.')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                    ->required(),
                    Forms\Components\TextInput::make('last_name')
                    ->required(),
                    Forms\Components\TextInput::make('middle_name')
                    ->required(),
                ])->columns(3),
                Forms\Components\Section::make('Address')
                ->description('Please enter the address.')
                ->schema([
                    Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                        ->required(),
                    Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->required(),
                    Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                        ->required(),
                    Forms\Components\Select::make('department_id')
                    ->relationship('department', 'name' , modifyQueryUsing: fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()))
                    ->required(),
                    Forms\Components\TextInput::make('address')
                    ->required(),
                    Forms\Components\TextInput::make('zip_code')
                    ->required(),
                ])->columns(3),
                Forms\Components\Section::make('Dates')
                    ->description('Please enter the dates.')
                    ->schema([
                        Forms\Components\DatePicker::make('date_of_birth')
                        ->required(),
                        Forms\Components\DatePicker::make('date_of_hire')
                        ->required(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('country.name')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('state.name')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('city.name')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('department.name')
                ->sortable(),
            Tables\Columns\TextColumn::make('first_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('last_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('middle_name')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('address')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('zip_code')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('date_of_birth')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('date_of_hire')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Name')
                ->schema([
                    TextEntry::make('first_name'),
                    TextEntry::make('middle_name'),
                    TextEntry::make('last_name'),
                ])->columns(3),
                Section::make('Address')
                ->schema([
                    TextEntry::make('country.name'),
                    TextEntry::make('state.name'),
                    TextEntry::make('city.name'),
                    TextEntry::make('department.name'),
                    TextEntry::make('address'),
                    TextEntry::make('zip_code'),
                ])->columns(3),
                Section::make('Date')
                ->schema([
                    TextEntry::make('date_of_birth'),
                    TextEntry::make('date_of_hire'),
                ])->columns(2),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            // 'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
