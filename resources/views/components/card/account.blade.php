{{-- data = account --}}
<div id="account_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record">
    <div class="row flex-nowrap w-100 mx-0">
        <div class="col-8 col-md-10">
            <div class="d-flex w-100">
                <img src="/src/img/icon/{{ $data->icon->path }}" alt="{{ $data->name }}" height="45">
                <div class="ms-3 text-truncate">
                    <p class="mb-0 fw-bold">{{ $data->name }}</p>
                    <p class="mb-0 text-truncate small fw-light">{{ $data->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-2 text-end">
            <p class="mb-0 fw-bold">{{ Str::toRupiah($data->records->totalNominalInAccount(['fromMe'=>$data->transferFromMe, 'toMe'=>$data->transferToMe])) }}</p>
            <p class="mb-0 small fw-light">{{ $data->currency }}</p>
        </div>
    </div>
    {{-- <div class="position-absolute me-2 end-0 top-50 translate-middle-y">
        <p class="mb-0 text-end fw-bold">{{ Str::toRupiah($data->records->totalNominalInAccount(['fromMe'=>$data->transferFromMe, 'toMe'=>$data->transferToMe])) }}</p>
        <p class="mb-0 text-end small fw-light">{{ $data->currency }}</p>
    </div> --}}
</div>