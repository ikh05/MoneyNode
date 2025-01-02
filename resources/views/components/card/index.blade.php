<div class="row px-3 px-sm-0">
    <div class="card mb-3 px-0">
        <div class="card-header position-relative py-3">
            {{ $slot }}
        </div>
        <div class="card-body d-flex p-3 gap-1 flex-column">
            {{-- Detail Pengeluaran --}}
            <x-dynamic-component :component="$component" class="mt-4" :data="$data->first()"/>
            @foreach ($data->skip(1) as $d)
                <hr class="m-0">
                <x-dynamic-component :component="$component" :data="$d"/>
            @endforeach
        </div>
    </div>
</div>