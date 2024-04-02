@php
    use Illuminate\Support\Str;
    $path = $getState('path');
    $imagePath = $path;
    $filename = pathinfo($imagePath, PATHINFO_FILENAME);
    $desiredPart = Str::of($filename)->beforeLast('.');
    $filePath = 'public/' . $imagePath;
@endphp
<style>
    div.table_profile_img{
        width: 25px;
        display: flex;
        justify-content: center;
        align-content: center;
    }
    img.table_profile_image{
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }
</style>
<div class="table_profile_img">
    <img src="{{ Storage::url($filePath) }}" alt="{{ $desiredPart }}" class="table_profile_image">
</div>
