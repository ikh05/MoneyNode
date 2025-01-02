{{-- data = account --}}
<div id="account_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record">
    <div class="d-flex">
        <img src="/src/img/icon/{{ $data->icon->path }}" alt="{{ $data->name }}" height="45">
        <div class="ms-3">
            <p class="mb-0 fw-bold">{{ $data->name }}</p>
            <p class="mb-0 small text-nowrap fw-light">{{ $data->deskripsi }}</p>
        </div>
    </div>
    <div class="position-absolute me-2 end-0 top-50 translate-middle-y">
        <p class="mb-0 text-end fw-bold">{{ Str::toRupiah($data->records->totalNominalInAccount(['fromMe'=>$data->transferFromMe, 'toMe'=>$data->transferToMe])) }}</p>
        <p class="mb-0 text-end small fw-light">{{ $data->currency }}</p>
    </div>
</div>