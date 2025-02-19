<?php

namespace App\Filament\App\Widgets;

use Filament\Tables;
use App\Models\Employee;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAppEmployees extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Employee::query()->whereBelongsTo(Filament::getTenant()))
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('country.name'),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
            ]);

    }
}
