{{-- @dd(request('book')) --}}
<li class="nav-item">
    <a class="btn btn-dark nav-link text-center {{ $active ? 'active' : '' }}" href="{{ $href.(request('book') !== null ? '?book='.request('book') : '') }}" style="height: 150%">
        <img width="30" src="src/img/nav/{{ $slot }}.png" alt="{{ $slot }}">{{ $slot }}
    </a>
</li>