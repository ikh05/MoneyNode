{{-- @dd(request('book')) --}}
<li class="nav-item">
    <a class=" rounded-top-circle nav-link text-center {{ $active ? 'active' : '' }}" href="{{ $href.(request('book') !== null ? '?book='.request('book') : '') }}" style="height: 150%">
        <img src="src/img/nav/{{ $slot }}.png" alt="{{ $slot }}">
        <p class="mb-0">{{ $slot }}</p>
    </a>
</li>