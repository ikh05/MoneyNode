<div class="row px-3 px-sm-0">
    <div class="card mb-3 px-0">
        <div class="card-header position-relative py-3">
            <p class="mb-0 fw-bold">{{ Str::dateForID($date, 'l, d/m/Y') }}</p>
            <div class="text-end small fst-italic position-absolute end-0 me-3 top-50 translate-middle-y">
                <p class="fw-bold text-{{ $total > 0 ? 'success' : 'danger' }} {{ $total ? '' : 'd-none' }} mb-0 ">{{ $total > 0 ? 'Pemasukkan' : 'Pengeluaran' }}: {{ Str::toRupiah( $total, false) }}</p>
                <p class="fw-bold text-secondary {{ $transfer ? '' : 'd-none' }} mb-0 ">Transfer: {{ Str::toRupiah( $transfer) }}</p>
            </div>
        </div>
        <div class="card-body d-flex px-4 py-3 gap-2 flex-column">
            {{-- Detail Pengeluaran --}}
            <x-record.item :data="$data->first()" />
            @foreach ($data->skip(1) as $record)
                <hr class="m-0">
                <x-record.item :data="$record" />
            @endforeach
        </div>
    </div>
</div>