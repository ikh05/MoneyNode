<div id="user" class="d-flex px-2 mb-2 align-items-center">
    <div class="flex-grow-1">
        {{-- identitas --}}
        <p class="mb-0">Atur Hidupmu di Sini!</p>
        <h1 class="mb-0 fw-bold">{{ Str::title($user->name) }}</h1>
        <p class="mb-0 ms-1 small">
            @if ($user->tier === 'super_admin')
                <i class="fa-regular fa-user-crown"></i>
            @elseif($user->tier === 'admin')
                <i class="fa-regular fa-user-tie"></i>
            @elseif($user->tier === 'user')
                <i class="fa-regular fa-user"></i>
            @else
                <i class="fa-solid fa-question"></i>              
            @endif
            {{ '@'.$user->username }}
        </p>
    </div>
    <div class="flex-shrink-0">
        {{-- gambar --}}
        <x-pop-over id="popOver-user" data-bs-placement="left" title="{{ $user->username }}">
            <img class="rounded-circle border-1 border-danger" src="https://robohash.org/set_set4/bgset_bg1/{{ $user->username }}" alt="Icon User" width="60">
            <x-slot:content>
                <div class="list-group overflow-hidden list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action disabled">Pengaturan</a>
                    <a href="/sign/out" class="list-group-item  rounded-bottom-3 list-group-item-action">Keluar</a>
                </div>
            </x-slot>
        </x-pop-over>
    </div>
</div>

