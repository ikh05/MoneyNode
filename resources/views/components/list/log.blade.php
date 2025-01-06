<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- syarat ini berjalan dengan baik di luar loop ada .container --}}
@props(['log', 'date_format' => 'j M Y'])
<div class="row">
    <div class="col-auto icon d-flex justify-content-center align-items-center p-2 rounded-2 text-bg-secondary fs-3 fw-bold" style="width: 3rem; height: 3rem;">
    @switch($log->action)
        @case('create')
            <i class="fa-regular fa-octagon fa-plus"></i>
            @break
        @case('update')
            <i class="fa-regular fa-doutone fa-wrendi"></i>
            @break
        @default
            <i class="fa-regular fa-octagon fa-x-mark"></i>
    @endswitch
    </div>
    <div class="col">
        <div class="d-flex" id="log-{{ $log->id }}">
            <p parent-cut-width="#log-{{ $log->id }}" name-cut-width='log_{{ $log->id }}' class="border-1 border mb-0 fw-bold">{{ Str::title($log->model) }} </p>
            <p class="border-1 border mb-0 nowrap cut-width-log_{{ $log->id }}">{{ Str::dateForID($log->created_at, $date_format,'Y-m-d H:i:s') }}</p>
        </div>
        <div class="row border-1 border">
            <p class="mb-0 small fw-light text-truncate">{{ $log->description }}</p>
        </div>
    </div>
</div>