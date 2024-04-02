@php
    use App\Models\User;

    $id = $getState('id');
    $roles = User::find($id)->roles;
    $list_permissions = [];
    foreach ($roles as $role) {
        $permissions = $role->permissions->toArray();
        foreach ($permissions as $permission) {
            array_push($list_permissions, $permission['name']);
        }
    }
    $permissions = User::find($id)->permissions;
    foreach ($permissions as $permission) {
            array_push($list_permissions, $permission['name']);
    }
    $list_permissions = array_values(array_unique($list_permissions));

@endphp
<h1 class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Permissions</h1>
@if(!empty($list_permissions))
    @foreach($list_permissions as $permission)
        <span class="text-sm leading-6 text-gray-950 dark:text-white">{{ $permission }}</span>
        @if(!$loop->last)
            <span class="text-sm leading-6 text-gray-950 dark:text-white">,</span>
        @endif
    @endforeach
@endif
