@extends('layout.navbar')


@section('content')
<div class="row bg-danger-subtle py-2 px-5 position-relative">
    <div class="d-flex gap-2">

        @foreach ($auth->books as $b)
        <a class="text-center link-light link-underline link-underline-opacity-0 btn btn-outline-danger {{ $book->id ===  $b->id ? 'active' : ''}}" href="/book/{{ $b->id }}">
            <img src="/src/img/icon/{{ $b->icon->path }}" alt="icon book">
            <p>{{ $b->name }}</p>
            </a>
            @endforeach
        </div>
    </div>
    <div class="row mb-3">
        {{-- rekap dari buku ini --}}
    </div>
    {{-- @dd($records) --}}
    <div class="container overflow-auto" style="max-height: 100vh;">
@foreach ($records as $date => $item)
        <x-record :date=$date :data="$item" :total="$item->sumIf('nominal', 'type', 'income') - $item->sumIf('nominal', 'type', 'expense')" :transfer="$item->sumIf('nominal', 'type', 'transfer')"/>
@endforeach
    </div>
    <!-- Button trigger modal -->
    <div class="position-absolute">
        <button type="button" class="btn btn-primary position-fixed z-1 bottom-0 end-0 me-2" style="margin-bottom: calc(72px + 2 * 4px)" data-bs-toggle="modal" data-bs-target="#add-transaction-record">
            <img src="/src/img/nav/pen.png" alt="new" width="32">
        </button>
    </div>
  
    <!-- Modal -->
    <x-form.modal.create-record :book=$book :categories=$categories/>
@endsection