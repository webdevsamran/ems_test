@php
    $activities = $getState('activities') != null ? $getState('activities') : [];
    dump($activities);
@endphp
@foreach($activities as $activity)
    {{ dump($activity->description) }}
@endforeach
