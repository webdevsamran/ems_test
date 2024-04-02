@php

    $roles = $getState('roles') != null ? $getState('roles')->toArray(): [];

@endphp
<h1 class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Roles</h1>
@if(!empty($roles))
    @foreach($roles as $role)
        <span class="text-sm leading-6 text-gray-950 dark:text-white">{{ $role['name'] }}</span>
        @if(!$loop->last)
            <span class="text-sm leading-6 text-gray-950 dark:text-white">,</span>
        @endif
    @endforeach
@endif
