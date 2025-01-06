@props(['id', 'title' => 'IcA Title'])


<div data-bs-toggle="popover" {{ $attributes }} data-bs-title="{{ $title }}" content-popover="#{{ $id }}" >
    {{ $slot }}
</div>


<div class="d-none">
    <div id="{{ $id }}">
        {{ $content }}
    </div>
</div>