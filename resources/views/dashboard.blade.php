@extends('layout.root')

@section('content')
    {{-- User --}}
    <x-user.root  :user=$user />
    <div class="d-flex gap-1 justify-content-evenly my-4">
        {{-- Daftar App --}}
        {{-- yang muncul hanya 4 jika lebih yang lain akan di masukkan kedalam hidden  --}}
        <div class="text-center">
            <a href='/MoneyNode' class="btn btn-secondary disabled">
                <img src="/src/img/nav/money.png" alt="moneyNode" width="30">
            </a>
            <p class="small mb-0 fw-bold">Money Node</p>
        </div>
        <div class="text-center">
            <a href='/TaskNode' class="btn btn-secondary">
                <img src="/src/img/nav/task.png" alt="taskNode" width="30">
            </a>
            <p class="small mb-0 fw-bold">Task Node</p>
        </div>
    </div>

    <div>
        <p class="fw-bold mb-1 fs-4">Log</p>
        <div class="container border-top pt-2">
            <x-list.log :log="$data['log']->first()"/>
            @foreach ($data['log']->skip(1) as $log)
                <hr class="mx-0 my-1">
                <x-list.log :log=$log/>
            @endforeach
        </div>
    </div>
@endsection

