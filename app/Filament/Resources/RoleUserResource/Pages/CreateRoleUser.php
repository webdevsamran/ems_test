<?php

namespace App\Filament\Resources\RoleUserResource\Pages;

use App\Filament\Resources\RoleUserResource;
use App\Models\User;
use App\Models\UserProfile;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateRoleUser extends CreateRecord
{
    protected static string $resource = RoleUserResource::class;
    protected static bool $canCreateAnother = false;

    public function getCreatedNotification(): ?Notification
    {

        return Notification::make()
            ->title('Created')
            ->body('New User has been created.')
            ->success()
            ->send();
    }

    public function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model

    {
        $mainUserData = collect($data)->only(['name','email','password','status','department_id','designation_id','cnic_number','basic_salary'])->toArray();
        $user = User::create($mainUserData);

        /* Making Profiles Array and Inserting It Into Database */
        $profiles['user_id'] = $user->id;
        $profiles['path'] = $data['profile']['path'] ?? null;
        UserProfile::create($profiles);

        return $user;
    }
}
