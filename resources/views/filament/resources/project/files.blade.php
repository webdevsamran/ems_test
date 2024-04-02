<h1 class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Files</h1>
@php
    use Illuminate\Support\Str;
    $files = $getState('files') != null ? $getState('files')->toArray() : [];
//    dd($files);
@endphp
<style>
    ul.files_list {
        padding-left: 1em;
    }
    li.files_list_item{
        padding:4px 8px;
        border:1px solid #ccc;
        margin:4px 0;
        border-radius:4px;
    }
    li.files_list_item:hover{
        background-color:#eee;
        cursor:pointer;
    }
    li.files_list_item a{
        text-decoration:none;
        color:inherit;
    }
    li.files_list_item a:hover{
        text-decoration:underline;
    }
</style>
<ul class="files_list">
    @if(!empty($files))
        @foreach($files as $path)
            @php
                $imagePath = $path['file_path'];
                $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $filename = pathinfo($imagePath, PATHINFO_FILENAME);
                $desiredPart = Str::of($filename)->beforeLast('.');
                $filePath = 'public/' . $imagePath;
            @endphp
            <li class="files_list_item text-sm leading-6 text-gray-950 dark:text-white">
                <a href="{{ Storage::url($filePath) }}" download>{{ $desiredPart }}.{{ $fileExtension }}</a>
            </li>
        @endforeach
    @endif
</ul>
