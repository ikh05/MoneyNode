<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- syarat ini berjalan dengan baik di luar loop ada .container --}}
@props(['task', 'date_format' => 'j M Y', 'icon'])
<div class="row">
    <div class="col-auto icon d-flex justify-content-center align-items-center p-2 rounded-2 text-bg-secondary fs-3 fw-bold" style="width: 3rem; height: 3rem;">
        {{-- untuk sementara random, kedepannya bisa di pilih user --}}
        <i class="{{ $icon }} fa-solid "></i>
    </div>
    <div class="col pe-0 ms-2">
        <div class="row">
            <div class="col">
                @dd($task)
                <div class="row">{{ Str::title($task->category.' - '.$task->title) }}</div>
                <div class="row">
                    <div class="col">{{ $task->due_date }}</div>
                    <div class="col">{{ $task->is_group === null ? 'Individu' : 'Kelompok' }}</div>
                </div>
            </div>
            <div class="col-auto">
                {{-- statusss --}}
                Status
            </div>
        </div>
    </div>
</div>