@php
    $developers = $getState('user')!= null ? $getState('user')->toArray(): [];
@endphp
<h1 class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Developers</h1>
@if(!empty($developers))
    <p>
    @foreach($developers as $developer)
        <span class="text-sm leading-6 text-gray-950 dark:text-white">{{ $developer['user']['name'] }}</span>
            @if(!$loop->last)
                <span class="text-sm leading-6 text-gray-950 dark:text-white">,</span>
            @endif
    @endforeach
    </p>
@endif
