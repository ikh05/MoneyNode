@extends('layout.root')

@section('content')
    {{-- User --}}
    <x-user.root  :user=$user />
    <p class="fs-3 fw-bold text-center mt-4 mb-1">Task Node in {{ $classRoom->name }}</p>
    <div class="d-flex gap-1 justify-content-evenly mt-4 mb-3">
        {{-- Daftar App --}}
        {{-- yang muncul hanya 4 jika lebih yang lain akan di masukkan kedalam hidden  --}}
        <div class="text-center">
            <a href='#' class="btn btn-secondary disabled"><i class="fa-screen-users fa-solid fa-doutone"></i></a>
            <p class="small mb-0 fw-bold">Kelas</p>
        </div>
        <div class="text-center">
            <a href='#' class="btn btn-secondary disabled"><i class="fa-duotone fa-solid fa-person-to-door"></i></a>
            <p class="small mb-0 fw-bold">Keluar</p>
        </div>
        <div class="text-center">
            <a href='#' class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalTugas"><i class="fa-list-check fa-solid fa-doutone"></i></a>
            <p class="small mb-0 fw-bold">Tugas Baru</p>
        </div>
        <div class="text-center">
            <a href='#' class="disabled btn btn-secondary"><i class="fa-calendar-star fa-duotone fa-solid"></i></i></a>
            <p class="small mb-0 fw-bold">Kalender</p>
        </div>
        <div class="text-center">
            <a href='#' class="disabled btn btn-secondary"><i class="fa-comment fa-duotone fa-regular"></i></i></a>
            <p class="small mb-0 fw-bold">Chat</p>
        </div>
    </div>

    {{-- filter --}}
    <div id="filter" class="border-top border-bottom p-5">

    </div>

    {{-- @dd($icon->random()) --}}
    @if ($classRoom->assignments->count() > 0)
    <div class="container">
        <div class="container border-top pt-2">
            <x-list.task :task="$classRoom->assignments->first()" icon="{{ $icon->random() }}"/>
            @foreach ($classRoom->assignments->skip(1) as $task)
                <hr class="mx-0 my-1">
                <x-list.task :task=$task icon="{{ $icon->random() }}"/>
            @endforeach
        </div>
    </div>
    @else
        <p class="fs-2 text-center fw-bold my-3">Tidak Ada Tugas</p>
    @endif



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
                    <input required type="text" name="title" id="title" class="form-control" placeholder="Judul Tugas">
                    <label for="title">* Judul Tugas</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Gambaran Tugas">
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

