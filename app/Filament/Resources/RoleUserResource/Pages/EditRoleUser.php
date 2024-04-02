<?php

namespace App\Filament\Resources\RoleUserResource\Pages;

use App\Filament\Resources\RoleUserResource;
use App\Models\User;
use App\Models\UserProfile;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRoleUser extends EditRecord
{
    protected static string $resource = RoleUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }

    public function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Updated')
            ->body('User has been updated.')
            ->success()
            ->send();
    }

    public function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user_id = $data['id'];
        $data['profile'] = UserProfile::where('user_id', $user_id)->first() != null ? UserProfile::where('user_id', $user_id)->first()->toArray() : [];
        return parent::mutateFormDataBeforeFill($data);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $user_id = $data['id'];
        $mainUserData = collect($data)->only(['name','email','status','department_id','designation_id','cnic_number','basic_salary'])->toArray();
        User::where('id', $user_id)->update($mainUserData);

        /* Making Profiles Array and Updating It Into Database */
        $profiles['path'] = $data['profile']['path'];
        if(UserProfile::where('user_id', $user_id)->first() != null){
            UserProfile::where('user_id', $user_id)->update($profiles);
        }else{
            $profiles['user_id'] = $user_id;
            UserProfile::create($profiles);
        }

        return User::where('id', $user_id)->first();
    }
}
