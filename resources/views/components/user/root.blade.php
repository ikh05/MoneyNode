<div id="user" class="d-flex px-2 mb-2 align-items-center">
    <div class="flex-grow-1">
        {{-- identitas --}}
        <p class="mb-0">Atur Hidupmu di Sini!</p>
        <h1 class="mb-0 fw-bold">{{ Str::title($user->name) }}</h1>
        <p class="mb-0 ms-1 small"><i class="fa-regular fa-user{{ $user->is_admin ? '-crown' : '' }}"></i> {{ '@'.$user->username }}</p>
    </div>
    <div class="flex-shrink-0">
        {{-- gambar --}}
        <img class="rounded-circle border-1 border-danger" src="https://robohash.org/set_set4/bgset_bg1/{{ $user->username }}" alt="Icon User" width="60">
    </div>
</div>