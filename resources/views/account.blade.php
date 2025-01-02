@extends('layout.navbar')


@section('content')
<div class="row bg-danger-subtle position-relative px-1">
    <div class="row py-2 px-5 mb-3">
        <div class="row">
            <div class="col">
                <p class="mb-0">Asset Bersih: {{ Str::toRupiah($account->totalAsset()) }}</p>
            </div>
            <div class="col">
                <p class="mb-0">Hutang: {{ Str::toRupiah($account['hutang']->totalNominalGroupAccounts()) }}</p>
            </div>
        </div>
    </div>
    <div class="container px-sm-5 px-3 pb-2 pt-4 bg-dark-subtle rounded-top-5 ">
    @foreach ($account as $key => $groupAccount)
        <x-card.index component="card.account" :data="$groupAccount" >
            <p class="mb-0 fw-bold">{{ Str::apa($key) }}</p>
            <div class="text-end small position-absolute end-0 me-3 top-50 translate-middle-y">
                <p class="fw-bold text-secondary mb-0 ">Asset: {{ Str::toRupiah($groupAccount->totalNominalGroupAccounts()) }}</p>
            </div>
        </x-card>
    @endforeach
    </div>
</div>
@endsection