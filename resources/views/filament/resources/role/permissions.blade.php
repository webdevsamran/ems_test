@php

    $permissions = $getState('permissions') != null ? $getState('permissions')->toArray() : [];

@endphp
<h1 class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Permissions</h1>
@if(!empty($permissions))
    @foreach($permissions as $permission)
        <span class="text-sm leading-6 text-gray-950 dark:text-white">{{ $permission['name'] }}</span>
        @if(!$loop->last)
            <span class="text-sm leading-6 text-gray-950 dark:text-white">,</span>
        @endif
    @endforeach
@endif
