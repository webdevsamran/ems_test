<?php

namespace App\Filament\Resources\RoleResource\Widgets;

use App\Filament\Resources\RoleResource\Pages\ListRoles;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RoleOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static bool $isLazy = false;
    protected function getTablePage(): string
    {
        return ListRoles::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Roles', $this->getPageTableQuery()->count())
                ->description('Total Roles Made So Far')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
