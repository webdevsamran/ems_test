<?php

namespace App\Filament\Resources\PermissionResource\Widgets;

use App\Filament\Resources\PermissionResource\Pages\ListPermissions;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PermissionOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static bool $isLazy = false;
    protected function getTablePage(): string
    {
        return ListPermissions::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Permissions', $this->getPageTableQuery()->count())
                ->description('Total Permissions Made So Far')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
