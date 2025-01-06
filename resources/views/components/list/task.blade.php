<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- syarat ini berjalan dengan baik di luar loop ada .container --}}
@props(['log', 'date_format' => 'j M Y'])
<div class="row">
    <div class="col-auto icon d-flex justify-content-center align-items-center p-2 rounded-2 text-bg-secondary fs-3 fw-bold" style="width: 3rem; height: 3rem;">
        
    </div>
    <div class="col pe-0">
        <div class="d-flex" id="log-{{ $log->id }}">
            <div class="flex-grow-1 w-100">
                <p class="mb-0 fw-bold">{{ Str::title($log->model) }} </p>
            </div>
            <div class="flex-shrink-0">
                <p class=" text-end d-block mb-0 nowrap">{{ Str::dateForID($log->created_at, $date_format,'Y-m-d H:i:s') }}</p>
            </div>
        </div>
        <div class="row m-0">
            <p class="mb-0 p-0 small fw-light text-truncate">{{ $log->description }}</p>
        </div>
    </div>
</div>