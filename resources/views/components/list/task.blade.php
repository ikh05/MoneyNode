<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- syarat ini berjalan dengan baik di luar loop ada .container --}}
@props(['task', 'date_format' => 'D, d M Y', 'icon'])
<li class="px-0 list-group-item list-group-item-action list" 
  category="{{ Str::lower($task->category) }}" 
  title="{{ Str::lower($task->title) }}"
  data-bs-toggle="tooltip" 
  data-bs-placement="bottom" 
  data-bs-title="{{ Str::title($task->title) }}">
    <div class="container-fluid">
        <div class="d-flex w-100" id="parent-task-{{ $task->id }}">
            {{-- icon --}}
            <div class="cut-width-task dropdown" style="min-width: 3rem; max-width: 3rem;">
                <button type="button" data-bs-toggle="dropdown" class="d-flex justify-content-center align-items-center btn-secondary h-100 rounded btn w-100">
                    <i class="{{ $icon }} fa-solid fs-3"></i>
                </button>
                <ul class="dropdown-menu dropdown-normal">
                    <form action="{{ route('assignment.delete', $task->id) }}" class="form-delete" method="POST">
                        @csrf
                        @method('DELETE')
                        @if ($task->creator_id === Auth::user()->id) 
                            <li class="dropdown-item btn-delete" teks-confirm="Apakah anda yakin menghapus tugas: {{ $task->category.'-'.$task->title }}?">Delete</li>
                        @elseif (Auth::user()->tier === 'super_admin' && $task->creator_id !== Auth::user()->id)
                            <li class="dropdown-item btn-delete" teks-confirm="Sebagai super admin, apakah anda yakin menghapus tugas: {{ $task->category.'-'.$task->title }}?">Delete - Super Admin</li>
                        @elseif (Auth::user()->tier === 'admin' && $task->creator_id !== Auth::user()->id)
                            <li class="dropdown-item btn-delete" teks-confirm="Sebagai admin, apakah anda yakin menghapus tugas: {{ $task->category.'-'.$task->title }}?">Delete - Admin</li>
                        @endif
                    </form>
                </ul>
            </div>
            <div class="px-2" parent-cut-width="#parent-task-{{ $task->id }}" name-cut-width="task">
                {{-- @dd($task) --}}
                <p class="mb-0 text-truncate">{{ $task->creator_id === Auth::user()->id ? '*' : '' }}{{ $task->category.' - '.Str::title($task->title) }}</p>
                <div class="d-flex justify-content-between">
                    <p class="mb-0 fw-light text-secondary-emphasis">{{$task->due_date === null ? 'No dateline' : Str::dateForID($task->due_date, $date_format, 'Y-m-d H:i:s') }}</p>
                    <p class="mb-0 me-2 text-{{ $task->is_group == 0 ? 'success-emphasis' : 'warning-emphasis' }}" style="font-size: .75rem">{{ $task->is_group == 0 ? 'Individu' : 'Kelompok' }}</p>
                </div>
                <div class="d-flex align-items-center">
                    <select url="/TaskNode/update/task" triger-ajax='input' ajax-assignment_id="{{ $task->id }}" name="status" id="status" class="dropdown-toggle btn btn-success ajax" style="font-size: .75rem">
                        <option class="d-none">{{ $task->recordById->count() ? Str::replace(['_', '-'],' ',Str::title($task->recordById[0]->status)) : 'Panding' }}</option>
                        <option value="pending" class="text-bg-secondary">Panding</option>
                        <option value="in_progress" class="text-bg-secondary">In Progres</option>
                        <option value="completed" class="text-bg-secondary">Completed</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</li>