@if ($data->account_id !== null)
{{-- data = record --}}
<div id="record_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record action-hover px-3 py-2">
    <div class="d-flex w-100" id="record-{{ $data->id }}-parent">
        <!-- Gambar kategori -->
        <div class="cut-width-desciption flex-shrink-0">
            <img class="me-2" src="/src/img/icon/{{ $data->category->icon->path }}" alt="{{ $data->category->name }}" height="45">
        </div>
    
        <!-- Bagian data yang memuat teks dan nama akun -->
        <div class="data flex-grow-1">
            <div class="d-flex w-100">
                <div class="flex-grow-1">
                    <p class="mb-0 fw-bold">{{ $data->category->name }}</p>
                </div>
                <div class="flex-shrink-0">
                    <p class="mb-0 text-{{ $data->category->type === 'income' ? 'success' : 'danger' }} fw-bold">{{ Str::toRupiah($data->nominal, false) }}</p>
                </div>
            </div>
            <div class="d-flex w-100">
                <!-- Deskripsi dengan teks yang dapat terpotong -->
                <div class="flex-grow-1">
                    <p name-cut-width="desciption" parent-cut-width="#record-{{ $data->id }}-parent" class="mb-0 small text-truncate fw-light" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $data->party->name.($data->description !== null ? '/'.$data->description : '') }}
                    </p>
                </div>
                <!-- Nama akun -->
                <div class="cut-width-desciption flex-shrink-0">
                    <p class="mb-0 ms-2 small fw-light">{{ $data->account->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
{{-- Transfer --}}
<div id="record_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record action-hover px-3 py-2">
    <div class="d-flex w-100" id="record-{{ $data->id }}-parent">
        <!-- Gambar kategori -->
        <div class="cut-width-desciption flex-shrink-0">
            <img class="me-2" src="/src/img/icon/{{ $data->transferTo->icon->path }}" alt="{{ $data->transferTo->name }}" height="45">
        </div>
    
        <!-- Bagian data yang memuat teks dan nama akun -->
        <div class="data flex-grow-1">
            <div class="d-flex w-100">
                <div class="flex-grow-1">
                    <p class="mb-0 fw-bold">Transfer</p>
                </div>
                <div class="flex-shrink-0">
                    <p class="mb-0 pemasukkan text-secondary fw-bold">{{ Str::toRupiah($data->nominal) }}</p>
                </div>
            </div>
            <div class="d-flex w-100">
                <!-- Deskripsi dengan teks yang dapat terpotong -->
                <div class="flex-grow-1">
                    <p name-cut-width="desciption" parent-cut-width="#record-{{ $data->id }}-parent" class="mb-0 small text-truncate fw-light">{{ $data->description === null ? '-' : $data->description }}</p>
                </div>
                <!-- Nama akun -->
                <div class="cut-width-desciption flex-shrink-0">
                    <p class="mb-0 small fw-light">{{ $data->transferFrom->name }} - {{ $data->transferTo->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- <div id="record_{{ $data->id }}" class="d-flex position-relative w-100 align-items-center item-record action-hover px-3 py-2">
    <div class="row flex-nowrap mx-0 w-100">
        <div class="col">
            <div class="d-flex w-100">
                <img src="/src/img/icon/{{ $data->transferTo->icon->path }}" alt="{{ $data->transferTo->name }}" height="45">
                <div class="ms-3 text-truncate">
                    <p class="mb-0 fw-bold">Transfer</p>
                </div>
            </div>
        </div>
        <div class="col-2 col-md-1 position-relative">
            <div class="position-absolute text-nowrap end-0 text-end">
                <p class="mb-0 pemasukkan text-secondary fw-bold">{{ Str::toRupiah($data->nominal) }}</p>
            </div>
        </div>
    </div>
</div> --}}
@endif