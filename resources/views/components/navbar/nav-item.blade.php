@props(['label' => '', 'href'=>''])
<div class="nav-item">
    <a class="nav-link text-center link-light" href="{{ $href.(request('book') ? '?book='.request('book') : '/') }}">
        <img src="src/img/nav/{{ $slot }}.png" alt="{{ $slot }}">
        {{-- <p class="mb-0">{{ $slot }}</p> --}}
    </a>
</div>