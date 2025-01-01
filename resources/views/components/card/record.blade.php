<div id="record_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record">
    <div class="d-flex">
@if ($data->account_id !== null)
        <img src="/src/img/icon/{{ $data->category->icon->path }}" alt="{{ $data->category->name }}" height="45">
        <div class="ms-3">
            <p class="mb-0 fw-bold">{{ $data->category->name }}</p>
            <p class="mb-0 small text-nowrap fw-light">{{ $data->party->name.($data->deskripsi !== null ? '/' : '').$data->deskripsi }}</p>
        </div>
    </div>
    <div class="position-absolute me-2 end-0 top-50 translate-middle-y">
        <p class="mb-0 text-end pemasukkan text-{{ $data->category->type === 'income' ? 'success' : 'danger' }} fw-bold">{{ Str::toRupiah($data->nominal, false) }}</p>
        <p class="mb-0 text-end small fw-light">{{ $data->account->name }}</p>
@else
{{-- Transfer --}}
        <img src="/src/img/icon/{{ $data->transferTo->icon->path }}" alt="{{ $data->transferTo->name }}" height="45">
        <div class="ms-3">
            <p class="mb-0 fw-bold">Transfer</p>
            <p class="mb-0 small text-nowrap fw-light">{{ $data->deskripsi === null ? '-' : $data->deskripsi }}</p>
        </div>
    </div>
    <div class="position-absolute me-2 end-0 top-50 translate-middle-y">
        <p class="mb-0 text-end pemasukkan text-secondary fw-bold">{{ Str::toRupiah($data->nominal) }}</p>
        <p class="mb-0 text-end small fw-light">{{ $data->transferFrom->name }} - {{ $data->transferTo->name }}</p>
@endif
    </div>
</div>