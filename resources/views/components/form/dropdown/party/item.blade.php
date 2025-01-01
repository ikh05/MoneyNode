<li class="dropdown-item w-100 px-1 {{ isset($active) ? 'active' : '' }}" value="{{ $data->id }}"> 
    <div class="row justify-content-center align-items-center">
        <div class="col"><img src="src/img/icon/{{ $data->icon->path }}" alt="" class="innerHTML" height="30"></div>
        <div class="col">
            <p class="mb-0 me-1 ms-3 text-end">{{ $data->name }}</p>
        </div>
    </div>
    {{-- icon | nama party --}}
</li>