<ul class="dropdown-menu" style="min-width: 13rem !important;">
    <li class="dropdown-item-text py-0"><p class="mb-0 text-bold">{{ $title }}</p></li>
    <li><hr class="dropdown-divider"></li>
    {{ $slot }}
    @if ($keterangan)
        <li><hr class="dropdown-divider"></li>
        <li class="dropdown-item-text"><p class="small text-end mb-0">{{ $keterangan }}</p></li>
    @endif
</ul>