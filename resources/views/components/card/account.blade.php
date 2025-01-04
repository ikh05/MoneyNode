{{-- data = account --}}
<div id="account_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record action-hover px-3 py-2">
    <div class="d-flex w-100" id="account-{{ $data->id }}-parent">
        <!-- Gambar kategori -->
        <div class="cut-width-desciption flex-shrink-0">
            <img class="me-2" src="/src/img/icon/{{ $data->icon->path }}" alt="{{ $data->name }}" height="45">
        </div>
    
        <!-- Bagian data yang memuat teks dan nama akun -->
        <div class="data flex-grow-1">
            <div class="d-flex w-100">
                <div class="flex-grow-1">
                    <p class="mb-0 fw-bold">{{ $data->name }}</p>
                </div>
                <div class="flex-shrink-0">
                    <p class="mb-0 fw-bold text-{{ $data->records->totalNominalInAccount(['fromMe'=>$data->transferFromMe, 'toMe'=>$data->transferToMe]) < 0 ? 'danger' : 'normal' }}">{{ Str::toRupiah($data->records->totalNominalInAccount(['fromMe'=>$data->transferFromMe, 'toMe'=>$data->transferToMe])) }}</p>
                </div>
            </div>
            <div class="d-flex w-100">
                <!-- Deskripsi dengan teks yang dapat terpotong -->
                <div class="flex-grow-1">
                    <p name-cut-width="desciption" parent-cut-width="#account-{{ $data->id }}-parent" class="mb-0 small text-truncate fw-light" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ ($data->description !== null ? $data->description : '-') }}
                    </p>
                </div>
                <!-- Nama akun -->
                <div class="cut-width-desciption flex-shrink-0">
                    <p class="mb-0 ms-2 small fw-light">{{ $data->currency }}</p>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    {{-- <div class="row flex-nowrap w-100 mx-0">
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
    </div> --}}
    {{-- <div class="position-absolute me-2 end-0 top-50 translate-middle-y">
        <p class="mb-0 text-end fw-bold">{{ Str::toRupiah($data->records->totalNominalInAccount(['fromMe'=>$data->transferFromMe, 'toMe'=>$data->transferToMe])) }}</p>
        <p class="mb-0 text-end small fw-light">{{ $data->currency }}</p>
    </div> --}}
</div>