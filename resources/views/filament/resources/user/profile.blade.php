@php
    use Illuminate\Support\Str;
    $path = $getState('path');
    $imagePath = $path;
    $filename = pathinfo($imagePath, PATHINFO_FILENAME);
    $desiredPart = Str::of($filename)->beforeLast('.');
    $filePath = 'public/' . $imagePath;
@endphp
<style>
    div.profile_img{
        width: 100%;
        display: flex;
        justify-content: center;
        align-content: center;
    }
    img.profile_image{
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }
</style>
<div class="profile_img">
    @if($filePath != null)
        <img src="{{ Storage::url($filePath) }}" alt="{{ $desiredPart }}" class="profile_image">
    @else
        <x-filament::avatar
            src="https://filamentphp.com/dan.jpg"
            alt="Admin Avatar"
            class="profile_image"
        />
    @endif

</div>
