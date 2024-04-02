<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected static bool $canCreateAnother = false;

    public function getCreatedNotification(): ?Notification
    {

        return Notification::make()
            ->title('Created')
            ->body('The Role has been created.')
            ->success()
            ->send();
    }

    public function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
