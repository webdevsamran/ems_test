@php
    $skills = $getState('name') ?? [];
@endphp
<h1 class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Skills</h1>
@if(!empty($skills))
    @foreach($skills as $skill)
        <span class="text-sm leading-6 text-gray-950 dark:text-white">{{ $skill['name'] }}</span>
        @if(!$loop->last)
            <span class="text-sm leading-6 text-gray-950 dark:text-white">,</span>
        @endif
    @endforeach
@endif
