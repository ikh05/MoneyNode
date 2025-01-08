@extends('layout.root')

@section('content')
    {{-- User --}}
    <x-user.root  :user=$user />
    <p class="fs-3 fw-bold text-center mt-4 mb-1">Task Node in {{ $classRoom->name }}</p>
    <div class="d-flex gap-1 justify-content-evenly mt-4 mb-3">
        {{-- Daftar App --}}
        {{-- yang muncul hanya 4 jika lebih yang lain akan di masukkan kedalam hidden  --}}
        <div class="text-center">
            <a href='#' class="btn btn-secondary disabled"><i class="fs-3 fa-screen-users fa-solid fa-doutone"></i></a>
            <p class="small text-secondary mb-0 fw-bold">Kelas</p>
        </div>
        <div class="text-center">
            <a href='#' class="btn btn-secondary disabled"><i class="fs-3 fa-duotone fa-solid fa-person-to-door"></i></a>
            <p class="small text-secondary mb-0 fw-bold">Keluar</p>
        </div>
        <div class="text-center">
            <a href='#' class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTugas"><i class="fs-3 fa-list-check fa-solid fa-doutone"></i></a>
            <p class="small mb-0 fw-bold">Tugas Baru</p>
        </div>
        <div class="text-center">
            <a href='#' class="disabled btn btn-secondary"><i class="fs-3 fa-calendar-star fa-duotone fa-solid"></i></i></a>
            <p class="small text-secondary mb-0 fw-bold">Kalender</p>
        </div>
        <div class="text-center">
            <a href='#' class="disabled btn btn-secondary"><i class="fs-3 fa-comment fa-duotone fa-regular"></i></i></a>
            <p class="small text-secondary mb-0 fw-bold">Chat</p>
        </div>
    </div>

    {{-- filter --}}
    <div id="filter" target-filter='#task' class="border-top border-bottom p-sm-3 p-2 pb-2">
        <div class="row gap-2 mb-1">
            <div class="col p-0">
                <div class="form-floating">
                    <input type="text" name="title" id="title-task" class="form-control" placeholder="Cari Judul">
                    <label for="title-task">Cari Judul</label>
                </div>
            </div>
            <div class="col-auto p-0">
                <button class="btn btn-secondary w-100 h-100"><i class="fa-solid fa-filter-list fs-2"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <select name="category" id="" class="form-select pe-1 border-0 bg-transparent" style="font-size: .75rem">
                    <option value='' class="text-bg-dark" style="font-size: 1rem">Matkul/Mapel</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c }}" class="text-bg-dark" style="font-size: 1rem">{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <label class="my-auto text-secondary-emphasis " for="type_sort" style="font-size: .75rem">Sort by</label>
                    <select name="mapel/matkul" id="type_sort" class="rounded form-select border-0 bg-transparent" style="font-size: .75rem">
                        <option value='lat' class="text-bg-dark" style="font-size: 1rem">Lates</option>
                        <option value='desc' class="text-bg-dark" style="font-size: 1rem">Descending</option>
                    </select>
                </div>
            </div>
            
        </div>
    </div>

    {{-- @dd($icon->random()) --}}
    <div id="task" class="container p-0">
        @if ($assignments->count() > 0)
            <ul class="list-group w-100 list-group-flush">
                @foreach ($assignments as $task)
                    <x-list.task :task=$task icon="{{ $icon->random() }}"/>
                @endforeach
            </ul>
            <p class="allHidden fs-2 text-center fw-bold my-3 d-none">Tidak Ada Tugas yang Memenuhi Filter!</p>
        @else
            <p class="fs-2 text-center fw-bold my-3">Tidak Ada Tugas Sama sekali!</p>
        @endif
    </div>




    {{-- model addtugas --}}
    <form action="/TaskNode/create/task" method="POST" class="modal fade" id="modalTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        @csrf
        <input type="hidden" name="class_room_id" value="{{ $classRoom->id }}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tugas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-2">
                    <input required type="text" name="title" list="titles" id="title" class="form-control" placeholder="Judul Tugas" autocomplete="off">
                    <label for="title">* Judul Tugas</label>
                    <datalist id="titles">
                        @foreach ($title as $t)
                            <option value="{{ $t }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Gambaran Tugas" autocomplete="off">
                    <label for="description">Gambaran Tugas</label>
                </div>
                <div class="input-group mb-2">
                    {{-- label di click akan memunculkan pilih tanggal --}}
                    <label label="date-none" for="due_date" class="btn btn-secondary">Deadline</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" placeholder="Gambaran Tugas">
                </div>
                <div class="form-floating mb-2">
                    <input name="category" required list="categories" id="category" class="form-control" placeholder="Select or Enter a Category" autocomplete="off">
                    <label for="category">* Mapel/Matkul</label>
                    <datalist id="categories">
                        @foreach ($categories as $c)
                            <option value="{{ $c }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_group" name="is_group">
                    <label class="form-check-label" for="is_group">Ini tugas Kelompok</label>
                  </div>
                <p class="small fw-light text-danger-emphasis">* Wajib diisi</p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </div>
        </div>
    </form>
@endsection

