<?php

namespace App\Filament\Resources\RoleUserResource\Widgets;

use App\Enums\CvStatus;
use App\Filament\Resources\RoleUserResource\Pages\ListRoleUsers;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RoleUserOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static bool $isLazy = false;
    protected function getTablePage(): string
    {
        return ListRoleUsers::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Employees', User::where('email', '!=', 'admin@admin.com')
                ->where(function($query) {
                    $query->whereNull('cv_status')
                        ->orWhere('cv_status', CvStatus::INTERN)
                        ->orWhere('cv_status', CvStatus::HIRED);
                })->count())
                ->description('Total Employees So Far')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Active Employees', User::where('email', '!=', 'admin@admin.com')
                ->where('status', '=',1)
                ->where(function($query) {
                    $query->whereNull('cv_status')
                        ->orWhere('cv_status', CvStatus::INTERN)
                        ->orWhere('cv_status', CvStatus::HIRED);
                })->count())
                ->description('Total Employees So Far')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Inactive Employees', User::where('email', '!=', 'admin@admin.com')
                ->where('status', '=',0)
                ->where(function($query) {
                    $query->whereNull('cv_status')
                        ->orWhere('cv_status', CvStatus::INTERN)
                        ->orWhere('cv_status', CvStatus::HIRED);
                })->count())
                ->description('Total Employees So Far')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
        ];
    }
}
