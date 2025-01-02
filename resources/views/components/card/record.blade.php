@if ($data->account_id !== null)
{{-- data = record --}}
<div id="record_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record">
    <div class="row flex-nowrap mx-0 w-100">
        <div class="col-8 col-md-10">
            <div class="d-flex w-100">
                <img src="/src/img/icon/{{ $data->category->icon->path }}" alt="{{ $data->category->name }}" height="45">
                <div class="ms-3 text-truncate">
                    <p class="mb-0 fw-bold">{{ $data->category->name }}</p>
                    <p class="mb-0 small text-truncate fw-light">{{ $data->party->name.($data->description !== null ? '/'.$data->description : '') }}</p>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 text-end">
            <p class="mb-0 pemasukkan text-{{ $data->category->type === 'income' ? 'success' : 'danger' }} fw-bold">{{ Str::toRupiah($data->nominal, false) }}</p>
            <p class="mb-0 small fw-light">{{ $data->account->name }}</p>
        </div>
    </div>
</div>
@else
{{-- Transfer --}}
<div id="record_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record">
    <div class="row flex-nowrap mx-0 w-100">
        <div class="col-8 col-md-10">
            <div class="d-flex w-100">
                <img src="/src/img/icon/{{ $data->transferTo->icon->path }}" alt="{{ $data->transferTo->name }}" height="45">
                <div class="ms-3 text-truncate">
                    <p class="mb-0 fw-bold">Transfer</p>
                    <p class="mb-0 small text-truncate fw-light">{{ $data->description === null ? '-' : $data->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 text-end">
            <p class="mb-0 pemasukkan text-secondary fw-bold">{{ Str::toRupiah($data->nominal) }}</p>
            <p class="mb-0 small fw-light">{{ $data->transferFrom->name }} - {{ $data->transferTo->name }}</p>
        </div>
    </div>
</div>
@endif