<?php

namespace App\Filament\App\Widgets;

use App\Models\Team;
use App\Models\Employee;
use App\Models\Department;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAppOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('User', Team::find(Filament::getTenant())->first()->members->count())
            ->description('All user from this website')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Department', Department::query()->whereBelongsTo(Filament::getTenant())->count())
            ->description('All team from this website')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
            Stat::make('Employee', Employee::query()->whereBelongsTo(Filament::getTenant())->count())
            ->description('All employee from this website')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}
