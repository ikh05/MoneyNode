<li class="dropdown-item w-100 {{ isset($active) ? 'active' : '' }}" value="{{ $data->id }}" onclick="selectAccount(this)">
    <div class="row">
        <div class="col-4 align-items-center d-flex">
            <div class="innerHTML">
                <img src="src/img/icon/{{ $data->icon->path }}" alt="{{ $data->name }}" height="30">
                @if ($label)
                    <p class="d-none p-0 m-0 fs-6 label small">{{ $data->name }}</p>
                @endif
            </div>
        </div>
        <div class="col-8 text-end">
            <p class="m-0 p-0 fs-6">{{ $data->name }}</p>
            <p class="saldo m-0 p-0 {{ !isset($active) ? 'text-secondary' : '' }} small">{{ Str::toRupiah($data->lastSaldo()) }}</p>
        </div>
    </div>    
</li>