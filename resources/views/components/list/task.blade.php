<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- syarat ini berjalan dengan baik di luar loop ada .container --}}
@props(['task', 'date_format' => 'j M Y', 'icon'])
<div class="d-flex" id="task-{{ $task->id }}">
    <div class="cut-width-task-{{ $task->id }} col-auto icon d-flex justify-content-center align-items-center p-2 rounded-2 text-bg-secondary fs-3" style="width: 3rem; height: 3rem;">
        {{-- untuk sementara random, kedepannya bisa di pilih user --}}
        <i class="{{ $icon }} fa-solid "></i>
    </div>
    <div class="flex-grow-1 d-flex">
        {{-- cut --}}
        <div class="flex-grow-1 mx-2" parent-cut-width="#task-{{ $task->id }}" name-cut-width="task-{{ $task->id }}">
            <p class="fw-bold mb-0 text-truncate w-100">{{ $task->category.' - '.Str::title($task->title) }}</p>
            <div class="d-flex justify-content-between">
                <p class="mb-0 fw-light text-secondary-emphasis">{{$task->due_date === null ? 'No dateline' : Str::dateForID($task->due_date, 'D, d M Y', 'Y-m-d H:i:s') }}</p>
                <p class="m-0 me-2" style="font-size: .75rem">{{ $task->is_group == 0 ? 'Individu' : 'Kelompok' }}</p>
            </div>
        </div>
        <div class="cut-width-task-{{ $task->id }} d-flex justify-content-center align-items-center gap-2">
            <button class="btn btn-success" style="font-size: .75rem">{{ $task->record ? $task->record->status : 'Padding' }}</button>
        </div>
    </div>
</div>