<?php

namespace App\Filament\Resources\RoleUserResource\Pages;

use App\Filament\Resources\RoleUserResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListRoleUsers extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = RoleUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RoleUserResource\Widgets\RoleUserOverview::class
        ];
    }
}
