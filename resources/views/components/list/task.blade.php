<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- syarat ini berjalan dengan baik di luar loop ada .container --}}
@props(['task', 'date_format' => 'j M Y', 'icon'])
<li class="px-0 list-group-item list-group-item-action list" category="{{ $task->category }}" title="{{ $task->title }}">
    <div class="container-fluid">
        <div class="d-flex w-100" id="parent-task-{{ $task->id }}">
            {{-- icon --}}
            <div class="cut-width-task" style="min-width: 2.75rem">
                <div class="d-flex justify-content-center align-items-center bg-secondary h-100 rounded">
                    <i class="{{ $icon }} fa-solid"></i>
                </div>
            </div>
            <div class="px-2" parent-cut-width="#parent-task-{{ $task->id }}" name-cut-width="task">
                <p class="mb-0 text-truncate">{{ $task->category.' - '.Str::title($task->title) }}</p>
                <div class="d-flex justify-content-between">
                    <p class="mb-0 fw-light text-secondary-emphasis">{{$task->due_date === null ? 'No dateline' : Str::dateForID($task->due_date, 'D, d M Y', 'Y-m-d H:i:s') }}</p>
                    <p class="mb-0 me-2 text-{{ $task->is_group == 0 ? 'success-emphasis' : 'warning-emphasis' }}" style="font-size: .75rem">{{ $task->is_group == 0 ? 'Individu' : 'Kelompok' }}</p>
                </div>
            </div>
            <div class="cut-width-task d-flex align-items-center">
                <button class="btn btn-success" style="font-size: .75rem">{{ $task->record ? $task->record->status : 'Padding' }}</button>
            </div>
        </div>
    </div>
</li>