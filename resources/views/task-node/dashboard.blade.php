@extends('layout.root')

@section('content')
    {{-- User --}}
    <x-user.root  :user=$user />
    <form method="POST" >
        @csrf
        <p class="fs-3 fw-bold text-center mt-4 mb-1">Task Node</p>
        <div class="d-flex gap-1 justify-content-evenly mt-4 mb-3">
            {{-- Daftar App --}}
            {{-- yang muncul hanya 4 jika lebih yang lain akan di masukkan kedalam hidden  --}}
            <div class="text-center">
                <a href='#' class="btn btn-secondary"><i class="fa-screen-users fa-solid fa-doutone"></i></a>
                <p class="small mb-0 fw-bold">Kelas</p>
            </div>
            <div class="text-center">
                <a href='#' class="btn btn-secondary"><i class="fa-duotone fa-solid fa-person-to-door"></i></a>
                <p class="small mb-0 fw-bold">Keluar</p>
            </div>
            <div class="text-center">
                <a href='#' class="btn btn-secondary"><i class="fa-list-check fa-solid fa-doutone"></i></a>
                <p class="small mb-0 fw-bold">Tugas Baru</p>
            </div>
            <div class="text-center">
                <a href='#' class="disabled btn btn-secondary"><i class="fa-calendar-star fa-duotone fa-solid"></i></i></a>
                <p class="small mb-0 fw-bold">Kalender</p>
            </div>
        </div>

        {{-- filter --}}
        <div id="filter">
        
        </div>
    
        <div>
        <div class="container border-top pt-2">
            <x-list.task :log="$data['task']->first()"/>
                @foreach ($data['task']->skip(1) as $log)
                <hr class="mx-0 my-1">
                <x-list.task :log=$log/>
                @endforeach
            </div>
        </div>
    </form>
@endsection

