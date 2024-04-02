<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
    protected static bool $canCreateAnother = false;

    public function getCreatedNotification(): ?Notification
    {

        return Notification::make()
            ->title('Created')
            ->body('The Permission has been created.')
            ->success()
            ->send();
    }

    public function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
