@extends('layout.navbar')

@section('content')
<div class="row bg-danger-subtle py-2 px-4 position-relative">
    <div class="d-flex gap-2">
        <a class="text-center link-light link-underline link-underline-opacity-0 btn btn-outline-danger {{ $book->id ===  $auth->books[0]->id ? 'active' : ''}}" href="/">
            <img src="/src/img/icon/{{ $auth->books[0]->icon->path }}" alt="icon book">
            <p>{{ $auth->books[0]->name }}</p>
        </a>
        @foreach ($auth->books->skip(1) as $b)
            <a class="text-center link-light link-underline link-underline-opacity-0 btn btn-outline-danger {{ $book->id ===  $b->id ? 'active' : ''}}" href="?book={{ $b->id }}">
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
    <div class="container">
@foreach ($records as $date => $item)
    <x-card.index component="card.record" :data="$item" >
        <p class="mb-0 fw-bold">{{ Str::dateForID($date, 'l, d/m/Y') }}</p>
        <div class="text-end small fst-italic position-absolute end-0 me-3 top-50 translate-middle-y">
            <p class="fw-bold text-{{ $item->totalByIncomeExpense() > 0 ? 'success' : 'danger' }} {{ $item->totalByIncomeExpense() ? '' : 'd-none' }} mb-0 ">{{ $item->totalByIncomeExpense() > 0 ? 'Pemasukkan' : 'Pengeluaran' }}: {{ Str::toRupiah( $item->totalByIncomeExpense(), false) }}</p>
            <p class="fw-bold text-secondary {{ $item->totalByType('transfer') ? '' : 'd-none' }} mb-0 ">Transfer: {{ Str::toRupiah( $item->totalByType('transfer') ) }}</p>
        </div>
    </x-card>
@endforeach
    </div>
    <!-- Button trigger modal -->
    <div class="position-absolute">
        <button type="button" class="btn btn-primary position-fixed z-1 bottom-0 end-0 me-2" style="margin-bottom: calc(72px + 2 * 4px)" data-bs-toggle="modal" data-bs-target="#add-transaction-record">
            <img src="/src/img/nav/pen.png" alt="new" width="32">
        </button>
    </div>
  
    <!-- Modal -->
    <x-form.modal.create-record :book=$book :categories=$categories :accounts=$accounts/>
@endsection

