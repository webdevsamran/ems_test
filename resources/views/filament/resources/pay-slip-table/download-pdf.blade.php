@php
    use Illuminate\Support\Str;
    $path = ($getState('path')) ?? null;
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
    @if($path !== null)
        @php
            $imagePath = $path;
            $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $filename = pathinfo($imagePath, PATHINFO_FILENAME);
            $desiredPart = Str::of($filename)->beforeLast('.');
            $filePath = 'public/' . $imagePath;
        @endphp
        <li class="files_list_item text-sm leading-6 text-gray-950 dark:text-white">
            <a href="{{ Storage::url($filePath) }}" download>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </a>
        </li>
    @endif
</ul>
